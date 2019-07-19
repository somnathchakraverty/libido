<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('email-verification', 'Api\V1\UserController@emailVerification');
Route::group(['prefix' => 'v1', 'middleware' => ['ApiLog']], function() {
    Route::group(['prefix' => 'user'], function () {
        Route::post('sign-up', 'Api\V1\UserController@signUp');
        Route::post('login', 'Api\V1\UserController@login');
        Route::post('forgot-password', 'Api\V1\UserController@forgotPassword');
        Route::post('reset-password', 'Api\V1\UserController@resetPassword');
//        Route::get('terms-conditions', function (){
//            return view('terms');
//        });
//        Route::get('privacy-policies', function (){
//            return view('policy');
//        });
        Route::get('terms-conditions', 'Api\V1\UserController@termsCondition');
        Route::get('privacy-policies', 'Api\V1\UserController@privacyPolicy');
        Route::get('advertiser-icon', 'Api\V1\UserController@advertiserIcon');

        Route::group(['middleware' => ['ApiAuth']], function() {
            Route::get('logout', 'Api\V1\UserController@logout');
            Route::get('profile', 'Api\V1\UserController@getProfile');
            Route::post('complete-profile-1', 'Api\V1\UserController@completeProfileStep1');
            Route::post('complete-profile-2', 'Api\V1\UserController@completeProfileStep2');
            Route::post('complete-profile-3', 'Api\V1\UserController@completeProfileStep3');
            Route::post('update-username', 'Api\V1\UserController@updateUsername');
            Route::post('user-details-username', 'Api\V1\UserController@getUserDetailUsername');
            Route::post('change-password', 'Api\V1\UserController@postChangePassword');
            Route::post('touch-id', 'Api\V1\UserController@postTouchId');
        });
    });

    Route::group(['prefix' => 'encounter'], function () {
        Route::group(['middleware' => ['ApiAuth']], function() {
            Route::post('add-encounter-1', 'Api\V1\EncounterController@addEncounterStep1');
            Route::post('add-encounter-2', 'Api\V1\EncounterController@addEncounterStep2');
            Route::post('add-encounter-3', 'Api\V1\EncounterController@addEncounterStep3');
            Route::post('add-encounter-4', 'Api\V1\EncounterController@addEncounterStep4');
            Route::post('add-encounter-5', 'Api\V1\EncounterController@addEncounterStep5');
            Route::post('add-encounter-6', 'Api\V1\EncounterController@addEncounterStep6');
            Route::post('add-encounter-7', 'Api\V1\EncounterController@addEncounterStep7');
            Route::post('add-encounter-8', 'Api\V1\EncounterController@addEncounterStep8');
            Route::get('encounter-list', 'Api\V1\EncounterController@getEncounterList');
            Route::get('single-encounter/{id}', 'Api\V1\EncounterController@getSingleEncounter');
            Route::get('partner-list', 'Api\V1\EncounterController@getPartnerList');
            Route::get('protection-list', 'Api\V1\EncounterController@getProtectionList');
            Route::get('toy-list', 'Api\V1\EncounterController@getToyList');
            Route::get('room-list', 'Api\V1\EncounterController@getRoomList');
            Route::get('position-list', 'Api\V1\EncounterController@getPositionList');
            Route::get('filter', 'Api\V1\EncounterController@getFilter');
            Route::post('add-partner', 'Api\V1\EncounterController@addPartner');
            Route::post('add-long-term', 'Api\V1\EncounterController@addLongTerm');
            Route::post('remove-long-term', 'Api\V1\EncounterController@removeLongTerm');
            Route::post('add-room', 'Api\V1\EncounterController@addRoom');
            Route::post('add-position', 'Api\V1\EncounterController@addPosition');
            Route::post('fav-room', 'Api\V1\EncounterController@favRoom');
            Route::post('fav-position', 'Api\V1\EncounterController@favPosition');
            Route::delete('delete-encounter', 'Api\V1\EncounterController@deleteEncounter');
            Route::delete('delete-partner-flow', 'Api\V1\EncounterController@deletePartnerFlow');
            Route::delete('delete-room', 'Api\V1\EncounterController@deleteRoom');
            Route::delete('remove-partner', 'Api\V1\EncounterController@removePartner');
        });
    });

    Route::group(['prefix' => 'report'], function () {
        Route::group(['middleware' => ['ApiAuth']], function() {
            Route::get('total-record', 'Api\V1\ReportController@getRecord');
            Route::get('total-stats', 'Api\V1\ReportController@getStats');
            Route::post('streak', 'Api\V1\ReportController@postStreak');
            Route::post('average', 'Api\V1\ReportController@postAverage');
            Route::post('favourite', 'Api\V1\ReportController@postFavourite');
            Route::post('session', 'Api\V1\ReportController@postSession');
            Route::post('day-since', 'Api\V1\ReportController@postDaySince');
            Route::get('achievement', 'Api\V1\ReportController@getAchievement');
        });
    });

    Route::group(['prefix' => 'survey'], function () {
        Route::group(['middleware' => ['ApiAuth']], function() {
            Route::get('survey-list', 'Api\V1\SurveyController@surveyList');
            Route::get('question', 'Api\V1\SurveyController@getQuestion');
            Route::get('question/{surveyId}', 'Api\V1\SurveyController@getQuestionOfSurvey');
            Route::post('matching-report', 'Api\V1\SurveyController@postMatchReport');

            Route::post('matching-data','Api\V1\SurveyController@postMatchingData');

            Route::post('answer', 'Api\V1\SurveyController@postAnswer');
            Route::post('delete', 'Api\V1\SurveyController@postDeleteProgress');
        });
    });
});
