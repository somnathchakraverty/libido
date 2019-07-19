<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Providers\Admin\HomeServiceProvider;

class HomeController extends BaseController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $detail = HomeServiceProvider::homePageDetail($request->all());
        return view('admin.dashboard',compact('detail'));
    }

}
