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

Route::group(['prefix' => 'crud/form/'], function () {
	Route::resource('setting', 'FormSettingController');
  Route::resource('question', 'FormQuestionController');
	Route::resource('question_group', 'FormQuestionGroupController');	
	Route::resource('answer', 'FormAnswerController');
	Route::resource('result', 'FormResultController');
});


Route::get('/', 'MmsController@index');
Route::get('pendaftaran1', 'PendaftaranController@index');
Route::post('pendaftaran1', 'PendaftaranController@store');

Menu::make('MyNavBar', function($menu){

  $menu->add('Form Setting', array('action'  => 'FormSettingController@index'));
  $menu->add('Form Question', array('action'  => 'FormQuestionController@index'));
  $menu->add('Form Question Group', array('action'  => 'FormQuestionGroupController@index'));
  $menu->add('Form Answer', array('action'  => 'FormAnswerController@index'));
  $menu->add('Form Result', array('action'  => 'FormResultController@index'));

});
