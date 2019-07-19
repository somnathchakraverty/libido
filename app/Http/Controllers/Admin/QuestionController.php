<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Providers\Admin\QuestionServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\Encounter;

class QuestionController extends BaseController {
    /*
     * Question List
     */

    public function questionList($id) {
        return view('admin.question.question_list')->with('id', $id);
    }

    /*
     * Question List Ajax
     */

    public function getQuestionListAjax($id) {

        $response = QuestionServiceProvider::getQuestions($id);
        $user = $response['result']->questions;

        return Datatables::of($user)->addIndexColumn()
                        ->addColumn('action', function ($user) {
                            $html_data = '<div class="row">' .
                                    '<a class="col-xs-6 col-md-3 " href="/question/stats/' . $user["id"] . '" id="update-question-' . $user["id"] . '" >Stats</a>' .
                                    '<a class="col-xs-6 col-md-3 " href="/question/edit-question/' . $user["id"] . '" id="update-question-' . $user["id"] . '" ><span class="glyphicon glyphicon-edit"></span></a>' .
                                    '<a class="col-xs-6 col-md-3 " href="javascript:;" id="delete-question-' . $user["id"] . '" onclick="deleteQuestion(' . $user["id"] . ');"><span class="glyphicon glyphicon-trash"></span></a></div>';
                            return $html_data;
                        })
                        ->make(true);
    }

    public function getAddQuestion($id) {
        return view('admin.question.add-question')->with('id', $id);
    }

    public function postAddQuestion(Request $request) {
        $survey = SurveyQuestion::where('survey_id', $request->survey_id)->count();
        if ($survey > 20) {
            return redirect()->back()->withErrors(trans('messages.apis.user.no_more_add'));
        }

        $addQuestion = QuestionServiceProvider::addQuestion($request->all());
        if ($addQuestion['status']) {
            $response = redirect('question/question-list/' . $request->survey_id)->with('success_msg', trans('messages.apis.user.record_saved'));
        } else {
            $response = redirect()->back()->withErrors(trans('messages.exception_msg'));
        }
        return $response;
    }

    public function removeQuestion(Request $request) {
        $userId = $request->question_delete_id;
        $survey = SurveyQuestion::where('survey_id', $request->survey_id)->count();
        if ($survey < 2) {
            return redirect()->back()->withErrors(trans('messages.apis.user.one_ques_req'));
        }
        $user = SurveyQuestion::where('id', $userId)->delete();
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
            $s = Survey::where('is_active', 1)->first();
            if ($s) {
                return redirect()->back()->withErrors(trans('messages.apis.user.already_active'));
            } else {
                $user->is_active = 1;
                $user->save();
                return redirect()->back()->with('success_msg', trans('messages.apis.user.record_updated'));
            }
        }
    }

    public static function getEditQuestion($id) {
        $q = SurveyQuestion::where('id', $id)->first();
        return view('admin.question.edit-question')->with(['id' => $id, 'question' => $q->questions]);
    }

    public static function postEditQuestion(Request $request) {
        $addQuestion = QuestionServiceProvider::editQuestion($request->all());
        if ($addQuestion['status']) {
            $response = redirect('question/edit-question/' . $request->question_id)->with('success_msg', trans('messages.apis.user.record_saved'));
        } else {
            $response = redirect()->back()->withErrors(trans('messages.exception_msg'));
        }
        return $response;
    }

    public static function getStats($id, Request $request) {
        //print_r($request->city);exit;
        $q = SurveyAnswer::join('survey_questions', 'survey_questions.id', '=', 'survey_answers.question_id')->selectRaw('answers,count(*) as c,questions')->where('question_id', $id)->groupBy('answers')->get();
        //print_r($q);exit;
        $a = $b = $c = 0;
        $question = 'No Answer Yet.';
        foreach ($q as $v) {
            $question = $v->questions;
            if ($v->answers == 1) {
                $a = $v->c;
            }
            if ($v->answers == 2) {
                $b = $v->c;
            }
            if ($v->answers == 3) {
                $c = $v->c;
            }
        }

        $city = Encounter::select('city')->where('step', Encounter::STEP_EIGHT)->whereNotNull('city')->groupBy('city')->get();
        $country = Encounter::select('country')->where('step', Encounter::STEP_EIGHT)->whereNotNull('country')->groupBy('country')->get();

        return view('admin.question.stats')->with(['a' => $a, 'b' => $b, 'c' => $c, 'ques' => $question, 'city' => $city, 'country' => $country,'quesId'=>$id]);
    }

}
