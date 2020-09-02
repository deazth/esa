<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\ApplicantGroup;
use App\Models\Application;
use App\Models\Application_contact;

class ApplicantController extends Controller
{
  public function showform(Request $req){

    // dropdown menu
    $states = State::all()->sortBy('name');
    $appgrps = ApplicantGroup::all()->sortBy('name');

    return view('applicant.applyform', [
      'states' => $states,
      'appgrps' => $appgrps
    ]);
  }

  public function create(Request $req){
    // check for duplicate personal_id
    $dup = Application::where('personal_id', $req->personal_id)->first();
    if($dup){
      return back()->withInput()->withErrors([
        'personal_id' => 'user.personal_id_dup'
      ]);
    } else {
      $apl = new Application;
      $apl->personal_id = $req->personal_id;
      $apl->applicant_group_id = $req->app_grp_id;
      $apl->state_id = $req->state_id;
      $apl->name = $req->fullname;
      $apl->user_id = $req->user()->id;
      $apl->save();

      return redirect(route('user.apply.details', ['uuid' => $apl->uuid]))->with([
        'alert' => 'apl_draft_created',
        'a_type' => 'info'
      ]);
    }
  }

  public function details(Request $req, $uuid){
    if($uuid){
      $apl = Application::where('uuid', $req->uuid)->first();

      if($apl){
        $states = State::all()->sortBy('name');
        $appgrps = ApplicantGroup::all()->sortBy('name');
        $canedit = in_array($apl->status, [
          'draft'
        ]);



        return view('applicant.details', [
          'states' => $states,
          'appgrps' => $appgrps,
          'apl' => $apl,
          'canedit' => $canedit
        ]);

      } else {
        return redirect(route('home'))->with([
          'alert' => 'invalid application ID',
          'a_type' => 'warning'
        ]);
      }

    } else {
      dd('takde ID');
    }

  }

  public function submit(Request $req){
    $apl = Application::where('uuid', $req->uuid)->first();
    if($apl){

      if($apl->user_id != $req->user()->id){
        // someone else punya
        abort(403);
      }

      $apl->status = 'submit';
      $apl->save();

      return redirect()->back()->with([
        'alert' => 'apl_submitted',
        'a_type' => 'success'
      ]);

    } else {
      return back()->with([
        'alert' => 'apl_not_found',
        'a_type' => 'danger'
      ]);
    }
  }

  public function update(Request $req){
    $apl = Application::find($req->aid);
    if($apl){

      // if($apl->user_id != $req->user()->id){
      //   // deleting someone else punya contact
      //   abort(403);
      // }

      $apl->personal_id = $req->personal_id;
      $apl->applicant_group_id = $req->app_grp_id;
      $apl->state_id = $req->state_id;
      $apl->name = $req->fullname;
      $apl->save();

      return redirect()->back()->with([
        'alert' => 'apl_info_updated',
        'a_type' => 'success'
      ]);

    } else {
      return back()->with([
        'alert' => 'apl_not_found',
        'a_type' => 'danger'
      ]);
    }
  }

  public function addcontact(Request $req){
    $apl = Application::find($req->aid);
    if($apl){

      $apc = new Application_contact;
      $apc->application_id = $apl->id;
      $apc->type = $req->ctc_type;
      $apc->contact = $req->ctc_info;
      $apc->remark = $req->remark;
      $apc->save();

      return redirect()->back()->with([
        'alert' => 'ctc_added',
        'a_type' => 'success'
      ]);

    } else {
      return back()->with([
        'alert' => 'apl_not_found',
        'a_type' => 'danger'
      ]);
    }
  }

  public function delcontact(Request $req){
    $apl = Application::find($req->aid);
    if($apl){

      if($apl->user_id != $req->user()->id){
        // deleting someone else punya contact
        abort(403);
      }

      $apc = Application_contact::find($req->cid);

      if($apc){
        $apc->delete();
      }

      return redirect()->back()->with([
        'alert' => 'ctc_deled',
        'a_type' => 'success'
      ]);

    } else {
      return back()->with([
        'alert' => 'apl_not_found',
        'a_type' => 'danger'
      ]);
    }
  }
}
