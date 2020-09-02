<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Application_contact;

class WebApiController extends Controller
{
  public function GetApplicantContacts(Request $req){
    // dapatkan list of contact untuk application tu

    // return [[
    //   'id' => 1,
    //   'type' => __('lov.'.'mobile_phone'),
    //   'ctc' => '0111',
    //   'remark' => 'nom'
    // ],[
    //   'id' => 2,
    //   'type' => 'email',
    //   'ctc' => 'aku@bos.ko',
    //   'remark' => 'bos'
    // ]];

    if($req->filled('aid')){
      $ap = Application::find($req->aid);
      if($ap){
        $retv = [];
        foreach($ap->contacts as $acont){
          $retv[] = [
            'id' => $acont->id,
            'type' => __('lov.'.$acont->type),
            'ctc' => $acont->contact,
            'remark' => $acont->remark
          ];
        }

        return $retv;
      } else {
        // application 404
        return [];
      }
    } else {
      // no application id param
      return [];
    }
  }


}
