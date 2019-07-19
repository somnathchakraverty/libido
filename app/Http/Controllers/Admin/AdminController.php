<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Auth;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Providers\Admin\AdminServiceProvider;
class AdminController extends BaseController {

    /**
     * function is used for logout a user.
     *
     * @return void
     */
    public function getLogout() {
        Auth::Logout();
        return redirect('login');
    }

    /*
     * Change password
     */

    public function getChangePassword() {
        return view('admin.user.changed_password');
    }

    /*
     * Post Change Password
     */

    public function postChangePassword(ChangePasswordRequest $request) {

        if ($request->oldPassword == $request->password) {
            return redirect()->back()->with('error_msg', trans('messages.old_new_pass_same'));
        }
        $response = AdminServiceProvider::changePassword($request->all());
        if ($response['status'] == true) {

            return redirect()->back()->with('success_msg', $response['message']);
        } else {
            return redirect()->back()->with('error_msg', $response['message']);
        }
    }

}
