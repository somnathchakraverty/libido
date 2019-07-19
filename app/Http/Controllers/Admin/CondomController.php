<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Providers\Admin\CondomServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Condom;

class CondomController extends BaseController {
    /*
     * Condom List
     */

    public function condomList() {
        return view('admin.condom.condom_list');
    }

    /*
     * Condom List Ajax
     */

    public function getCondomListAjax() {

        $response = CondomServiceProvider::getCondoms();
        $user = $response['result']->condoms;
        
        return Datatables::of($user) ->addIndexColumn()
//                        ->addColumn('image', function($user) {
//                            $html_data = '<div style="margin:auto;width:50%;">' .
//                                    '<img src="' . $user['image'] . '" alt="Smiley face" height="180" width="280">' .
//                                    '</div>';
//                            return $html_data;
//                        })
                        ->addColumn('action', function ($user) {
                            $html_data = '<a href="javascript:;" id="delete-condom-' . $user["id"] . '" onclick="deleteCondom(' . $user["id"] . ');"><span class="glyphicon glyphicon-trash"></span></a>';
                            return $html_data;
                        })
                        ->make(true);
    }

    public function getAddCondom() {
        return view('admin.condom.add-condom');
    }

    public function postAddCondom(Request $request) {
        $addCondom = CondomServiceProvider::addCondom($request->all());
        if ($addCondom['status']) {
            $response = redirect('condom/condom-list')->with('success_msg', trans('messages.apis.user.record_saved'));
        } else {
            $response = redirect()->back()->withErrors(trans('messages.exception_msg'));
        }
        return $response;
    }

    public function removeCondom(Request $request) {
        $userId = $request->condom_delete_id;
        $user = Condom::where('id', $userId)->delete();
        if ($user) {
            if ($user) {
                return redirect()->back()->with('success_msg', trans('messages.apis.user.record_deleted'));
            } else {
                return redirect()->back()->withErrors(trans('messages.exception_msg'));
            }
        }
    }

}
