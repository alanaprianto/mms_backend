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

Route::get('/', 'MmsController@info');
Route::get('404', 'MmsController@notfound');
Route::get('informasi', 'MmsController@info');
Route::get('bantuan', 'MmsController@help');


// Auth
Route::get('login', 'LoginController@show');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

// Register
Route::get('register1', 'PendaftaranController@index');
Route::post('register1', 'PendaftaranController@store');
Route::get('register1frame', 'PendaftaranController@indexFrame');
Route::get('registeriiframe', 'PendaftaranController@indexiiFrame');
Route::get('register1success', 'PendaftaranController@success');
Route::get('register1successframe', 'PendaftaranController@successframe');
Route::get('register/{code}', 'PendaftaranController@register');
Route::post('register', 'PendaftaranController@createuser');

// Payment *percobaan
  Route::get('register1pay', 'MmsController@pay1');
  Route::post('register1pay', 'MmsController@pay1store');
  
// Authenticated
Route::group(['middleware' => 'auth'], function() {
  // Profile
  Route::get('profile', 'ProfileAdminController@index');
  Route::post('updateCAI/{id}', 'ProfileAdminController@updateCAI');
  Route::post('updateCYP/{id}', 'ProfileAdminController@updateCYP');
  
  // Route::get('profile', 'ProfileController@index');
  Route::get('profile/edit', 'ProfileController@edit');
  Route::get('profile/indexAjax/{id}', 'ProfileController@indexAjax');
  Route::get('profile/tahapiiAjax/{id}', 'ProfileController@tahapiiAjax');
  Route::get('profile/tahapiiiAjax/{id}', 'ProfileController@tahapiiiAjax');  

  // Register tahap 2
  Route::get('registerii', 'PendaftaranController@indexii');
  Route::post('registerii/{idqg}', 'PendaftaranController@storeii');

  // Image
  Route::get('images/{filename}', 'ImageController@images');
  Route::get('image-upload','ImageController@imageUpload');
  Route::post('image-upload','ImageController@imageUploadPost');  
  Route::get('uploadedfiles/{filename}', 'ImageController@uploadedfiles');  

  // Member
  Route::get('member', 'Member1Controller@dashboard');
  Route::get('member/kta', 'Member1Controller@kta');
  Route::post('member/ktaprint', 'Member1Controller@ktaprint');
  Route::get('member/printkta', 'Member1Controller@printkta');
  Route::get('member/rn', 'Member1Controller@regnum');
  Route::get('member/compprof', 'Member1Controller@compprof');
  Route::get('member/registerii', 'Member1Controller@indexii');
  Route::get('member/completeprofile/{id}', 'Member1Controller@completeprofile');

  // KTA
  Route::post('member/requestkta/', 'Member1Controller@requestkta');

});

// Get Territory
Route::get('ajax/listprovinsi', 'MmsController@listProvinsi');
Route::get('ajax/listdaerah/{id}', 'MmsController@listDaerah');

// Mms crud
Route::group(['prefix' => 'crud/form/', 'middleware' => 'auth.role.admin'], function () {
  Route::get('dashboard', 'MmsController@dashboardAdmin');
  Route::resource('setting', 'FormSettingController');
  Route::resource('types', 'FormTypeController');
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
    Route::get('types', 'FormTypeController@indexAjax');
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

Route::group(['prefix' => 'dashboard/', 'middleware' => 'auth.role.daerah'], function () {
  Route::get('daerah', 'KadinDaerahController@dashboard');
  Route::get('daerah/pendaftaran', 'KadinDaerahController@pendaftaran');
  Route::get('daerah/submitted', 'KadinDaerahController@submittedForms');
  Route::delete('daerah/submitted/delete/{code}', 'KadinDaerahController@submittedFormsDelete');
  Route::delete('daerah/member/delete/{id}', 'KadinDaerahController@memberDelete');
  Route::get('daerah/submitted/detail/{code}/a', 'KadinDaerahController@submittedFormDetail');
  Route::get('daerah/ajax/submittedforms', 'KadinDaerahController@ajaxForms');
  Route::get('daerah/ajax/submittedforms/{code}', 'KadinDaerahController@ajaxFormDetail');
  Route::get('daerah/member', 'KadinDaerahController@member');
  Route::get('daerah/member/{id}', 'KadinDaerahController@memberDetail');
  Route::get('daerah/ajax/members', 'KadinDaerahController@ajaxMembers');
  Route::get('daerah/ajax/members/{id}', 'KadinDaerahController@ajaxMemberDetail');
  Route::get('daerah/member/validate/{id}', 'KadinDaerahController@memberValidate');
  Route::post('daerah/member/validate/{id}', 'KadinDaerahController@memberValidate');
  Route::get('daerah/profile', 'KadinDaerahController@profile');  
  Route::get('daerah/notif/all', 'KadinDaerahController@notifall');
  Route::get('daerah/notif/{id}', 'KadinDaerahController@notif');
  Route::get('daerah/ajax/notifresult/{id}', 'KadinDaerahController@notifresultAjax');
  Route::get('daerah/ajax/notifuser/{id}', 'KadinDaerahController@notifuserAjax');
  Route::get('daerah/ajax/payment/{code}', 'KadinDaerahController@paymentAjax');
  Route::post('daerah/register1', 'KadinDaerahController@store');
  Route::post('daerah/member/requestkta', 'KadinDaerahController@memberReqKta');

});

Route::group(['prefix' => 'dashboard/', 'middleware' => 'auth.role.provinsi'], function () {
  Route::get('provinsi', 'KadinProvinsiController@dashboard');
  Route::get('provinsi/profile', 'KadinProvinsiController@profile');
  Route::get('provinsi/kta/list', 'KadinProvinsiController@ktaList');
  Route::get('provinsi/kta/list/{id}', 'KadinProvinsiController@ktaListDetail');
  Route::get('provinsi/kta/request', 'KadinProvinsiController@ktaRequest');
  Route::get('provinsi/kta/request/{id}', 'KadinProvinsiController@ktaRequestDetail');
  Route::get('provinsi/kta/cancel', 'KadinProvinsiController@ktaCancel');
  Route::get('provinsi/kta/cancel/{id}', 'KadinProvinsiController@ktaCancelDetail');
  Route::post('provinsi/kta/cancelkta/', 'KadinProvinsiController@cancelKta');  
  Route::post('provinsi/kta/insertkta/', 'KadinProvinsiController@insertKta');
  Route::get('provinsi/ajax/kta', 'KadinProvinsiController@ajaxKta');
  Route::get('provinsi/ajax/ktacancelled', 'KadinProvinsiController@ajaxKtaCancel');
  Route::get('provinsi/ajax/ktalist', 'KadinProvinsiController@ajaxKtaList');
  Route::get('provinsi/notif/all', 'KadinProvinsiController@notifall');
  Route::get('provinsi/notif/{id}', 'KadinProvinsiController@notif');
  Route::get('provinsi/valnas', 'KadinProvinsiController@valnas');
  Route::get('provinsi/ajax/valnas', 'KadinProvinsiController@ajaxvalnas');
});

Route::group(['prefix' => 'dashboard/', 'middleware' => 'auth.role.pusat'], function () {
  Route::get('pusat', 'KadinPusatController@dashboard');
  Route::get('pusat/notif/all', 'KadinPusatController@notifall');
  Route::get('pusat/notif/{id}', 'KadinPusatController@notif');
  Route::get('pusat/rn/list', 'KadinPusatController@rnList');
  Route::get('pusat/rn/list/{id}', 'KadinPusatController@rnListDetail');
  Route::get('pusat/ajax/rnlist', 'KadinPusatController@ajaxRnList');
  Route::get('pusat/rn/request', 'KadinPusatController@rnRequest');
  Route::get('pusat/rn/request/{id}', 'KadinPusatController@rnRequestDetail');
  Route::get('pusat/ajax/rn', 'KadinPusatController@ajaxRnRequest');
  Route::post('pusat/rn/insertrn/', 'KadinPusatController@insertRn');

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
