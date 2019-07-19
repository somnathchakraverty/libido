<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});


Route::get('user/reset-password', 'Web\UserController@getResetPassword');
Route::post('user/reset-password', 'Web\UserController@postResetPassword');

Auth::routes();


Route::group(['middleware' => ['App\Http\Middleware\Authenticate']], function () {
    Route::get('home', 'Admin\HomeController@index');
    Route::get('challenge', 'Admin\ChallengeController@report');
    Route::get('logout', 'Admin\AdminController@getlogout');

    Route::get('change-password', 'Admin\AdminController@getChangePassword');
    Route::post('change-password', 'Admin\AdminController@postChangePassword');

    Route::group(['prefix' => 'advertiser'], function () {
        Route::get('advertiser-list', 'Admin\AdvertiserController@advertiserList');
        Route::get('advertiser-list-ajax', 'Admin\AdvertiserController@getAdvertiserListAjax');
        Route::get('add-advertiser', 'Admin\AdvertiserController@getAddAdvertiser')->name('add_advertiser');
        Route::post('add-advertiser', 'Admin\AdvertiserController@postAddAdvertiser')->name('post_add_advertiser');
        Route::post('remove-advertiser', 'Admin\AdvertiserController@removeAdvertiser');
    });
    Route::group(['prefix' => 'toy'], function () {
        Route::get('toy-list', 'Admin\ToyController@toyList');
        Route::get('toy-list-ajax', 'Admin\ToyController@getToyListAjax');
        Route::get('add-toy', 'Admin\ToyController@getAddToy')->name('add_toy');
        Route::post('add-toy', 'Admin\ToyController@postAddToy')->name('post_add_toy');
        Route::post('remove-toy', 'Admin\ToyController@removeToy');
    });
    Route::group(['prefix' => 'condom'], function () {
        Route::get('condom-list', 'Admin\CondomController@condomList');
        Route::get('condom-list-ajax', 'Admin\CondomController@getCondomListAjax');
        Route::get('add-condom', 'Admin\CondomController@getAddCondom')->name('add_condom');
        Route::post('add-condom', 'Admin\CondomController@postAddCondom')->name('post_add_condom');
        Route::post('remove-condom', 'Admin\CondomController@removeCondom');
    });
    Route::group(['prefix' => 'survey'], function () {
        Route::get('survey-list', 'Admin\SurveyController@surveyList');
        Route::get('survey-list-ajax', 'Admin\SurveyController@getSurveyListAjax');
        Route::get('add-survey', 'Admin\SurveyController@getAddSurvey')->name('add_survey');
        Route::post('add-survey', 'Admin\SurveyController@postAddSurvey')->name('post_add_survey');
        Route::post('remove-survey', 'Admin\SurveyController@removeSurvey');
        Route::post('change-status', 'Admin\SurveyController@changeStatus');
    });
    Route::group(['prefix' => 'question'], function () {
        Route::get('question-list/{id}', 'Admin\QuestionController@questionList');
        Route::get('question-list-ajax/{id}', 'Admin\QuestionController@getQuestionListAjax');
        Route::get('add-question/{id}', 'Admin\QuestionController@getAddQuestion');
        Route::post('add-question', 'Admin\QuestionController@postAddQuestion')->name('post_add_question');
        Route::get('edit-question/{id}', 'Admin\QuestionController@getEditQuestion');
        Route::post('edit-question', 'Admin\QuestionController@postEditQuestion')->name('post_edit_question');
        Route::post('remove-question', 'Admin\QuestionController@removeQuestion');
        Route::get('stats/{id}', 'Admin\QuestionController@getStats');
    });
});

