<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Providers\Admin\AdvertiserServiceProvider;
use Illuminate\Http\Request;
use App\Models\Advertiser;
use App\Http\Requests\Admin\AddAdvertiserRequest;
use Yajra\Datatables\Datatables;

class AdvertiserController extends BaseController {
    /*
     * Advertiser List
     */

    public function advertiserList() {
        return view('admin.advertiser.advertiser_list');
    }

    /*
     * Advertiser List Ajax
     */

    public function getAdvertiserListAjax() {

        $response = AdvertiserServiceProvider::getAdvertisers();
        $user = $response['result']->advertisers;

        return Datatables::of($user)->addIndexColumn()
                        ->addColumn('image', function($user) {
                            $html_data = '<div style="margin:auto;width:50%;">' .
                                    '<img src="' . $user['image'] . '" alt="Smiley face" height="120" width="120">' .
                                    '</div>';
                            return $html_data;
                        })
                        ->addColumn('action', function ($user) {
                            $html_data = //'<a href="edit/' . $user["id"] . '" id="edit-video-' . $user["id"] . '" ><span class="glyphicon glyphicon-edit"></span> &nbsp;&nbsp;</a>' .
                                    '<a href="javascript:;" id="delete-advertiser-' . $user["id"] . '" onclick="deleteAdvertiser(' . $user["id"] . ');"><span class="glyphicon glyphicon-trash"></span></a>';
                            return $html_data;
                        })
                        ->make(true);
    }

    public function getAddAdvertiser() {
        return view('admin.advertiser.add-advertiser');
    }

    public function postAddAdvertiser(AddAdvertiserRequest $request) {
        $addAdvertiser = AdvertiserServiceProvider::addAdvertiser($request->all());
        if ($addAdvertiser['status']) {
            $response = redirect('advertiser/advertiser-list')->with('success_msg', trans('messages.apis.user.record_saved'));
        } else {
            $response = redirect()->back()->withErrors(trans('messages.exception_msg'));
        }
        return $response;
    }

    public function removeAdvertiser(Request $request) {
        $userId = $request->advertiser_delete_id;
        $user = Advertiser::where('id', $userId)->delete();
        if ($user) {
            if ($user) {
                return redirect()->back()->with('success_msg', trans('messages.apis.user.record_deleted'));
            } else {
                return redirect()->back()->withErrors(trans('messages.exception_msg'));
            }
        }
    }

}
