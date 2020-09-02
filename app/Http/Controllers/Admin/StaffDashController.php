<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class StaffDashController extends \App\Http\Controllers\Controller
{
  public function dashboard(Request $req){

    \Widget::add([
        'type'        => 'chart',
        'wrapper' => [
            'class' => 'col-md-6', // customize the class on the parent element (wrapper)
            'style' => 'border-radius: 10px;',
        ],
        'controller'  => \App\Http\Controllers\Admin\Charts\ApplicationStatusChartController::class
    ])->to('before_content');

    return view('staff.dashboard');
  }
}
