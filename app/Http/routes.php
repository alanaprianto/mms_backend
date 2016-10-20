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
Route::get('404', 'MmsController@notfound');

// Auth
Route::get('login', 'LoginController@show');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

// Register
Route::get('register1', 'PendaftaranController@index');
Route::post('register1', 'PendaftaranController@store');
Route::get('register1success', 'PendaftaranController@success');
Route::get('register/{code}', 'PendaftaranController@register');
Route::post('register', 'PendaftaranController@createuser');

// Authenticated
Route::group(['middleware' => 'auth'], function() {
  // Profile
  Route::get('profile', 'ProfileController@index');
  Route::get('profile/edit', 'ProfileController@edit');
  Route::get('profile/indexAjax/{id}', 'ProfileController@indexAjax');
  Route::get('profile/tahapiiAjax/{id}', 'ProfileController@tahapiiAjax');
  Route::get('profile/tahapiiiAjax/{id}', 'ProfileController@tahapiiiAjax');  

  // Register tahap 2
  Route::get('registerii', 'PendaftaranController@indexii');
  Route::post('registerii', 'PendaftaranController@storeii');

  // Image
  Route::get('images/{filename}', 'ImageController@images');
  Route::get('image-upload','ImageController@imageUpload');
  Route::post('image-upload','ImageController@imageUploadPost');

  // KTA
  Route::get('profile/requestkta/', 'ProfileController@requestkta');
});

// Get Territory
Route::get('ajax/listprovinsi', 'MmsController@listProvinsi');
Route::get('ajax/listdaerah/{id}', 'MmsController@listDaerah');

// Mms crud
Route::group(['prefix' => 'crud/form/', 'middleware' => 'auth.role'], function () {
  Route::resource('setting', 'FormSettingController');
  Route::resource('type', 'FormTypeController');
  Route::resource('rules', 'FormRulesController');
  Route::resource('question', 'FormQuestionController');  
  Route::resource('question_group', 'FormQuestionGroupController'); 
  Route::resource('answer', 'FormAnswerController');
  Route::resource('result', 'FormResultController');
  Route::resource('user', 'UserController');
  Route::resource('member', 'MemberController');
  Route::get('notif/all', 'NotifController@notifall');
  Route::get('notif/{id}', 'NotifController@notif');
  Route::group(['prefix' => 'ajax/'], function () {
    Route::get('setting', 'FormSettingController@indexAjax');
    Route::get('type', 'FormTypeController@indexAjax');
    Route::get('rules', 'FormRulesController@indexAjax');
    Route::get('question', 'FormQuestionController@indexAjax');
    Route::get('question_group', 'FormQuestionGroupController@indexAjax');
    Route::get('answer', 'FormAnswerController@indexAjax');
    Route::get('result', 'FormResultController@indexAjax');
    Route::get('user', 'UserController@indexAjax');
    Route::get('userresultAjax/{id}', 'UserController@userresultAjax');
    Route::get('member', 'MemberController@indexAjax');
    Route::get('memberresultAjax/{id}', 'MemberController@memberresultAjax');
    Route::get('notifresult/{id}', 'NotifController@notifresultAjax');
    Route::get('notifuser/{id}', 'NotifController@notifuserAjax');
  });
  Route::get('question/whereSetting/{id}', 'FormQuestionController@whereSetting');
});

Route::group(['prefix' => 'dashboard/', 'middleware' => 'auth.role'], function () {
  Route::get('daerah', 'KadinDaerahController@dashboard');
  Route::get('daerah/pendaftaran', 'KadinDaerahController@pendaftaran');
  Route::get('daerah/submitted', 'KadinDaerahController@submittedForms');
  Route::delete('daerah/submitted/delete/{code}', 'KadinDaerahController@submittedFormsDelete');
  Route::get('daerah/submitted/{code}', 'KadinDaerahController@submittedFormDetail');
  Route::get('daerah/ajax/submittedforms', 'KadinDaerahController@ajaxForms');
  Route::get('daerah/ajax/submittedforms/{code}', 'KadinDaerahController@ajaxFormDetail');
  Route::get('daerah/member', 'KadinDaerahController@member');
  Route::get('daerah/member/{id}', 'KadinDaerahController@memberDetail');
  Route::get('daerah/ajax/members', 'KadinDaerahController@ajaxMembers');
  Route::get('daerah/ajax/members/{id}', 'KadinDaerahController@ajaxMemberDetail');
  Route::get('daerah/member/validate/{id}', 'KadinDaerahController@memberValidate');
  Route::get('daerah/profile', 'KadinDaerahController@profile');  
  Route::get('daerah/notif/all', 'KadinDaerahController@notifall');
  Route::get('daerah/notif/{id}', 'KadinDaerahController@notif');
  Route::get('daerah/ajax/notifresult/{id}', 'KadinDaerahController@notifresultAjax');
  Route::get('daerah/ajax/notifuser/{id}', 'KadinDaerahController@notifuserAjax');

  Route::get('provinsi', 'KadinProvinsiController@dashboard');
  Route::get('provinsi/profile', 'KadinProvinsiController@profile');
  Route::get('provinsi/kta/list', 'KadinProvinsiController@ktaList');
  Route::get('provinsi/kta/list/{id}', 'KadinProvinsiController@ktaListDetail');
  Route::get('provinsi/kta/request', 'KadinProvinsiController@ktaRequest');
  Route::get('provinsi/kta/request/{id}', 'KadinProvinsiController@ktaRequestDetail');
  Route::get('provinsi/kta/cancel', 'KadinProvinsiController@ktaCancel');
  Route::get('provinsi/kta/cancel/{id}', 'KadinProvinsiController@ktaCancelDetail');
  Route::get('provinsi/kta/cancelkta/{id}', 'KadinProvinsiController@cancelKta');  
  Route::post('provinsi/kta/insertkta/', 'KadinProvinsiController@insertKta');
  Route::get('provinsi/ajax/kta', 'KadinProvinsiController@ajaxKta');
  Route::get('provinsi/ajax/ktacancelled', 'KadinProvinsiController@ajaxKtaCancel');
  Route::get('provinsi/ajax/ktalist', 'KadinProvinsiController@ajaxKtaList');
  Route::get('provinsi/notif/all', 'KadinProvinsiController@notifall');
  Route::get('provinsi/notif/{id}', 'KadinProvinsiController@notif');  
});

// Percobaan
Route::get('percobaan', 'PercobaanController@percobaan');
Route::post('percobaan', 'PercobaanController@percobaanstore');

// Crud Navigation Bar
// Menu::make('MyNavBar', function($menu){

//   $menu->add('Form Setting', array('action'  => 'FormSettingController@index'));
//   $menu->add('Form Type', array('action'  => 'FormTypeController@index'));
//   $menu->add('Form Rules', array('action'  => 'FormRulesController@index'));
//   $menu->add('Form Question', array('action'  => 'FormQuestionController@index'));
//   $menu->add('Form Question Group', array('action'  => 'FormQuestionGroupController@index'));
//   $menu->add('Form Answer', array('action'  => 'FormAnswerController@index'));
//   $menu->add('Form Result', array('action'  => 'FormResultController@index'));  

// });
