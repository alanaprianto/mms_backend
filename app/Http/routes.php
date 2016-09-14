<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'MmsController@index');

// Auth
Route::get('login', 'LoginController@index');
Route::get('register1', 'PendaftaranController@index');
Route::post('register1', 'PendaftaranController@store');

// Mms crud
Route::group(['prefix' => 'crud/form/'], function () {
  Route::resource('setting', 'FormSettingController');
  Route::resource('question', 'FormQuestionController');
  Route::resource('question_group', 'FormQuestionGroupController'); 
  Route::resource('answer', 'FormAnswerController');
  Route::resource('result', 'FormResultController');
  // Route::group(['prefix' => 'ajax/'], function () {
  //   Route::get('setting', 'FormSettingController@indexAjax');
  //   Route::get('question', 'FormQuestionController@indexAjax');
  //   Route::get('question_group', 'FormQuestionGroupController@indexAjax');
  //   Route::resource('answer', 'FormAnswerController@indexAjax');
  //   Route::resource('result', 'FormResultController@indexAjax');
  // });
});

Menu::make('MyNavBar', function($menu){

  $menu->add('Form Setting', array('action'  => 'FormSettingController@index'));
  $menu->add('Form Question', array('action'  => 'FormQuestionController@index'));
  $menu->add('Form Question Group', array('action'  => 'FormQuestionGroupController@index'));
  $menu->add('Form Answer', array('action'  => 'FormAnswerController@index'));
  $menu->add('Form Result', array('action'  => 'FormResultController@index'));

});
