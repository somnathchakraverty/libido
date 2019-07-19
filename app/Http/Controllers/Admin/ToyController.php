<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Providers\Admin\ToyServiceProvider;
use Illuminate\Http\Request;
use App\Models\Toy;
use App\Http\Requests\Admin\AddToyRequest;
use Yajra\Datatables\Datatables;

class ToyController extends BaseController {
    /*
     * Toy List
     */

    public function toyList() {
        return view('admin.toy.toy_list');
    }

    /*
     * Toy List Ajax
     */

    public function getToyListAjax() {

        $response = ToyServiceProvider::getToys();
        $user = $response['result']->toys;

        return Datatables::of($user)->addIndexColumn()
                        ->addColumn('image', function($user) {
                            $html_data = '<div style="margin:auto;width:50%;">' .
                                    '<img src="' . $user['image'] . '" alt="Smiley face" height="120" width="120">' .
                                    '</div>';
                            return $html_data;
                        })
                        ->addColumn('action', function ($user) {
                            $html_data = //'<a href="edit/' . $user["id"] . '" id="edit-video-' . $user["id"] . '" ><span class="glyphicon glyphicon-edit"></span> &nbsp;&nbsp;</a>' .
                                    '<a href="javascript:;" id="delete-toy-' . $user["id"] . '" onclick="deleteToy(' . $user["id"] . ');"><span class="glyphicon glyphicon-trash"></span></a>';
                            return $html_data;
                        })
                        ->make(true);
    }

    public function getAddToy() {
        return view('admin.toy.add-toy');
    }

    public function postAddToy(AddToyRequest $request) {
        $addToy = ToyServiceProvider::addToy($request->all());
        if ($addToy['status']) {
            $response = redirect('toy/toy-list')->with('success_msg', trans('messages.apis.user.record_saved'));
        } else {
            $response = redirect()->back()->withErrors(trans('messages.exception_msg'));
        }
        return $response;
    }

    public function removeToy(Request $request) {
        $userId = $request->toy_delete_id;
        $user = Toy::where('id', $userId)->delete();
        if ($user) {
            if ($user) {
                return redirect()->back()->with('success_msg', trans('messages.apis.user.record_deleted'));
            } else {
                return redirect()->back()->withErrors(trans('messages.exception_msg'));
            }
        }
    }

}
