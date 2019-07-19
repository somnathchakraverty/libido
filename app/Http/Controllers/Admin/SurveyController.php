<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Providers\Admin\SurveyServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends BaseController {
    /*
     * Survey List
     */

    public function surveyList() {
        return view('admin.survey.survey_list');
    }

    /*
     * Survey List Ajax
     */

    public function getSurveyListAjax() {

        $response = SurveyServiceProvider::getSurveys();
        $user = $response['result']->surveys;
        $questionCount = 0;
        return Datatables::of($user)->addIndexColumn()
                        ->addColumn('is_active', function ($user) {
                            $html_data = '';
                            if ($user['is_active'] == 1)
                                $html_data = 'Active';
                            else
                                $html_data = 'Inactive';
                            return $html_data;
                        })
                        ->addColumn('questionCount', function ($user) {
                            return \App\Models\SurveyQuestion::where('survey_id', $user['id'])->count();
                        })
                        
                        ->addColumn('action', function ($user) {
                            if ($user['is_active'] == 1)
                                $insertData = '<a class="col-xs-6 col-md-3 " href="javascript:;" id="change-status-' . $user["id"] . '" onclick="changeStatus(' . $user["id"] . ',0' .');">Inactive</a>';
                            else
                                if(\App\Models\SurveyQuestion::where('survey_id', $user['id'])->count() > 0){
                                    $insertData = '<a class="col-xs-6 col-md-3 " href="javascript:;" id="change-status-' . $user["id"] . '" onclick="changeStatus(' . $user["id"] . ',1' . ');">Active</a>';
                                }else{
                                    $insertData= '<span class="col-xs-6 col-md-3 " href="javascript:;" id="change-status-' . $user["id"] . '" onclick="warningStatus(' . $user["id"] . ');">No Questions</span>';
                                }

                            $html_data = '<div class="row">' .
                                    '<a class="col-xs-6 col-md-3 " href="/question/question-list/' . $user["id"] . '" >View Questions</a>' . $insertData .
                                    '<a class="col-xs-6 col-md-3 " href="javascript:;" id="delete-survey-' . $user["id"] . '" onclick="deleteSurvey(' . $user["id"] . ');"><span class="glyphicon glyphicon-trash"></span></a></div>';
                            return $html_data;
                        })
                        ->make(true);
    }

    public function getAddSurvey() {
        return view('admin.survey.add-survey');
    }

    public function postAddSurvey(Request $request) {
        $addSurvey = SurveyServiceProvider::addSurvey($request->all());
        if ($addSurvey['status']) {
            $response = redirect('survey/survey-list')->with('success_msg', trans('messages.apis.user.record_saved'));
        } else {
            $response = redirect()->back()->withErrors(trans('messages.exception_msg'));
        }
        return $response;
    }

    public function removeSurvey(Request $request) {
        $userId = $request->survey_delete_id;
        $user = Survey::where('id', $userId)->delete();
        if ($user) {
            if ($user) {
                return redirect()->back()->with('success_msg', trans('messages.apis.user.record_deleted'));
            } else {
                return redirect()->back()->withErrors(trans('messages.exception_msg'));
            }
        }
    }

    public static function changeStatus(Request $request) {
        $userId = $request->change_status_id;
        $user = Survey::where('id', $userId)->first();
        if ($user->is_active == 1) {
            $user->is_active = 0;
            $user->save();
            return redirect()->back()->with('success_msg', trans('messages.apis.user.record_updated'));
        } else {
            $user->is_active = 1;
            $user->save();
            return redirect()->back()->with('success_msg', trans('messages.apis.user.record_updated'));
        }
    }

}
