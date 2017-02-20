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

Route::get('register2', 'PendaftaranController@index2');
Route::post('register2', 'PendaftaranController@store2');

// Payment *percobaan
Route::get('register1pay', 'MmsController@pay1');
Route::post('register1pay', 'MmsController@pay1store');

// KTA Tracking
Route::post('ktatrack', 'MmsController@ktatrack');
Route::post('ktatrack/requestkta/', 'MmsController@ktatrackrequestkta');
Route::get('ktatrack/{code}', 'MmsController@ktatrackcode');

// KBLI
Route::post('kbli/list', 'MmsController@kblilist');
Route::get('kbli/list1', 'MmsController@kblilist1');

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
  Route::get('images/product/thumbnail/{id}', 'ImageController@imageThumbProduct');
  Route::get('images/product/{id}', 'ImageController@imageProduct');
  Route::get('images/slider/thumbnail/{name}', 'ImageController@imageThumbSlider');
  Route::get('images/slider/{name}', 'ImageController@imageSlider');


  // Marketplace
  Route::post('marketplace/create_gallery/', 'MarketPlaceController@create_gallery');
  Route::post('marketplace/update_gallery/', 'MarketPlaceController@update_gallery');
  Route::post('marketplace/delete_gallery/', 'MarketPlaceController@delete_gallery');
  Route::get('marketplace/ajax/listBarang/', 'MarketPlaceController@listBarang');
  Route::get('marketplace/ajax/listJasa/', 'MarketPlaceController@listJasa');

  // Percobaan
  Route::get('percobaan', 'PercobaanController@percobaan');
  Route::post('percobaan', 'PercobaanController@percobaanstore');
  Route::post('percobaan/rchatLogin', 'PercobaanController@rchatLogin');
});

// Member
Route::group(['prefix' => 'member/', 'middleware' => 'auth.role.member'], function () {
  // Member
  Route::get('dashboard', 'MemberController@dashboard');
  Route::get('kta', 'MemberController@kta');
  Route::get('ajax/kta', 'MemberController@ajaxKta');
  Route::post('ktaprint', 'MemberController@ktaprint');
  Route::get('printkta', 'MemberController@printkta');
  Route::get('rn', 'MemberController@regnum');
  Route::get('compprof', 'MemberController@compprof');
  Route::get('registerii', 'MemberController@indexii');
  Route::get('completeprofile/{id}', 'MemberController@completeprofile');

  // KTA
  Route::post('requestkta/', 'MemberController@requestkta');
  Route::post('extkta', 'MemberController@extkta');

  // Market
  Route::resource('marketplace', 'MarketPlaceController');
});

// Get Territory
Route::get('ajax/listprovinsi', 'MmsController@listProvinsi');
Route::get('ajax/listdaerah/{id}', 'MmsController@listDaerah');

// Mms crud
Route::group(['prefix' => 'admin', 'middleware' => 'auth.role.admin'], function () {
  Route::get('dashboard', 'MmsController@dashboardAdmin');
  Route::post('chart/adm_donut', 'AdminChartController@adm_donut');
  Route::post('chart/adm_dblbar', 'AdminChartController@adm_dblbar');
  Route::post('chart/adm_member', 'AdminChartController@adm_member');
  Route::post('chart/adm_dynform', 'AdminChartController@adm_dynform');
  
  Route::resource('setting', 'FormSettingController');
  Route::resource('types', 'FormTypeController');
  Route::resource('rules', 'FormRulesController');
  Route::resource('question', 'FormQuestionController');  
  Route::resource('question_group', 'FormQuestionGroupController'); 
  Route::resource('answer', 'FormAnswerController');
  Route::resource('result', 'FormResultController');
  Route::resource('user', 'AdminUserController');
  Route::resource('member', 'AdminMemberController');
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
    Route::get('user', 'AdminUserController@indexAjax');
    Route::get('userresultAjax/{id}', 'AdminUserController@userresultAjax');
    Route::get('member', 'AdminMemberController@indexAjax');
    Route::get('memberresultAjax/{id}', 'AdminMemberController@memberresultAjax');
    Route::get('notifresult/{id}', 'NotifController@notifresultAjax');
    Route::get('notifuser/{id}', 'NotifController@notifuserAjax');
    Route::get('marketplace/category', 'AdminCategoryController@indexAjax');
    Route::get('marketplace/slider', 'AdminSliderController@indexAjax');
  });
  Route::get('question/whereSetting/{id}', 'FormQuestionController@whereSetting');
  Route::resource('marketplace/category', 'AdminCategoryController');
  Route::resource('marketplace/slider', 'AdminSliderController');
});

// Kadin Daerah 
Route::group(['prefix' => 'daerah/', 'middleware' => 'auth.role.daerah'], function () {  
  Route::get('dashboard', 'KadinDaerahController@dashboard');

  // pendaftaran
  Route::get('pendaftaran', 'KadinDaerahController@pendaftaran'); 

  // form anggota biasa
  Route::get('submitted', 'KadinDaerahController@submittedForms'); 
  Route::get('ajax/submittedforms', 'KadinDaerahController@ajaxForms');
  Route::delete('submitted/delete/{code}', 'KadinDaerahController@submittedFormsDelete'); 
  Route::get('submitted/detail/{code}/a', 'KadinDaerahController@submittedFormDetail');
  // Route::get('daerah/ajax/submittedforms/{code}', 'KadinDaerahController@ajaxFormDetail');
  
  // member anggota biasa
  Route::get('member', 'KadinDaerahController@member');
  Route::get('ajax/members', 'KadinDaerahController@ajaxMembers');
  Route::delete('member/delete/{id}', 'KadinDaerahController@memberDelete');
  Route::get('member/validate/{id}', 'KadinDaerahController@memberValidate');
  Route::post('member/validate/{id}', 'KadinDaerahController@memberValidate');
  Route::post('member/requestkta', 'KadinDaerahController@memberReqKta');
  Route::get('member/detail/{id}', 'KadinDaerahController@memberDetail');
  // Route::get('daerah/ajax/members/{id}', 'KadinDaerahController@ajaxMemberDetail');

  // profile
  Route::get('profile', 'KadinDaerahController@profile');  

  // notifikasi
  Route::get('notif/all', 'KadinDaerahController@notifall');
  Route::get('notif/{id}', 'KadinDaerahController@notif');
  Route::get('ajax/notifresult/{id}', 'KadinDaerahController@notifresultAjax');
  Route::get('ajax/notifuser/{id}', 'KadinDaerahController@notifuserAjax');

  // payment
  Route::get('ajax/payment/{code}', 'KadinDaerahController@paymentAjax');
  Route::post('register1', 'KadinDaerahController@store');

  // anggota luar biasa
  Route::get('submitted/alb', 'KadinDaerahController@submittedAlbForms');
  Route::get('submitted/alb/detail/{code}', 'KadinDaerahController@submittedAlbFormDetail');
  Route::post('submitted/alb/approve', 'KadinDaerahController@submittedAlbApprove');
  Route::get('ajax/submittedforms/alb', 'KadinDaerahController@ajaxAlbForms');
  Route::get('member/alb', 'KadinDaerahController@memberAlb');
  Route::get('member/alb/detail/{id}', 'KadinDaerahController@memberAlbDetail');
  Route::get('ajax/members/alb', 'KadinDaerahController@ajaxAlbMembers');

  // grafik  
  Route::post('chart/sf_stat', 'DaerahChartController@sf_stat');
  Route::post('chart/member_stat', 'DaerahChartController@member_stat');
});

// Kadin Provinsi
Route::group(['prefix' => 'provinsi/', 'middleware' => 'auth.role.provinsi'], function () {
  Route::get('dashboard', 'KadinProvinsiController@dashboard');
  Route::get('profile', 'KadinProvinsiController@profile');
  Route::get('kta/list', 'KadinProvinsiController@ktaList');
  Route::get('kta/list/{id}', 'KadinProvinsiController@ktaDetail');
  Route::get('kta/request', 'KadinProvinsiController@ktaRequest');
  Route::get('kta/request/{id}', 'KadinProvinsiController@ktaDetail');
  Route::get('kta/cancel', 'KadinProvinsiController@ktaCancel');
  Route::get('kta/cancel/{id}', 'KadinProvinsiController@ktaDetail');
  Route::post('kta/cancelkta/', 'KadinProvinsiController@cancelKta');  
  Route::post('kta/insertkta/', 'KadinProvinsiController@insertKta');
  Route::get('kta/expired', 'KadinProvinsiController@ktaExpired');
  Route::get('kta/expired/{id}', 'KadinProvinsiController@ktaDetail');
  Route::get('kta/extension', 'KadinProvinsiController@ktaExtension');
  Route::get('kta/extension/{id}', 'KadinProvinsiController@ktaDetail');
  Route::get('ajax/kta', 'KadinProvinsiController@ajaxKta');
  Route::get('ajax/ktacancelled', 'KadinProvinsiController@ajaxKtaCancel');
  Route::get('ajax/ktalist', 'KadinProvinsiController@ajaxKtaList');
  Route::get('ajax/ktaexpired', 'KadinProvinsiController@ajaxKtaExpired');
  Route::get('ajax/ktaext', 'KadinProvinsiController@ajaxKtaExtension');
  Route::get('notif/all', 'KadinProvinsiController@notifall');
  Route::get('notif/{id}', 'KadinProvinsiController@notif');
  Route::get('valnas', 'KadinProvinsiController@valnas');
  Route::get('ajax/valnas', 'KadinProvinsiController@ajaxvalnas');
  Route::get('valnas/{id}', 'KadinProvinsiController@ktaDetail');

  //Chart
  Route::post('chart/kta_stat', 'ProvinsiChartController@kta_stat');
});

// Kadin Pusat
Route::group(['prefix' => 'pusat/', 'middleware' => 'auth.role.pusat'], function () {
  Route::get('dashboard', 'KadinPusatController@dashboard');
  Route::get('notif/all', 'KadinPusatController@notifall');
  Route::get('notif/{id}', 'KadinPusatController@notif');
  Route::get('rn/list', 'KadinPusatController@rnList');
  Route::get('rn/list/{id}', 'KadinPusatController@memberDetail');
  Route::get('ajax/rn/list', 'KadinPusatController@ajaxRnList1');
  // Route::get('ajax/rnlist', 'MmsController@ajaxRnList');
  Route::get('rn/request', 'KadinPusatController@rnRequest');
  Route::get('rn/request/{id}', 'KadinPusatController@memberDetail');
  Route::get('ajax/rn/request', 'KadinPusatController@ajaxRnRequest');
  Route::post('rn/insertrn/', 'KadinPusatController@insertRn');
  Route::get('ktaext', 'KadinPusatController@ktaExt');
  Route::get('ktaext/{id}', 'KadinPusatController@memberDetail');
  Route::get('ajax/ktaext', 'KadinPusatController@ajaxKtaExtension');
  Route::post('ktaext/process', 'KadinPusatController@ktaExtensionProcess');  
});

// Member ALB
Route::group(['prefix' => 'alb/', 'middleware' => 'auth.role.alb'], function () {  
  Route::get('dashboard', 'AlbController@dashboard');
  Route::get('kta', 'AlbController@kta');
  Route::get('rn', 'AlbController@regnum');
  Route::get('compprof', 'AlbController@compprof');
  Route::get('compprof/edit', 'AlbController@compprofEdit');
  Route::get('completeprofile', 'AlbController@completeprofile');

  // KTA
  Route::post('requestkta/', 'AlbController@requestkta');
  Route::get('ajax/kta', 'AlbController@ajaxKta');
  Route::post('extkta', 'AlbController@extkta');
  Route::post('ktaprint', 'AlbController@ktaprint');
  Route::get('printkta', 'AlbController@printkta');

  Route::resource('marketplace', 'MarketPlaceController');
});

// API
Route::group(['prefix' => 'api/'], function() {
  Route::post('check_rn/{rn}', 'APIController@check_rn');
  Route::post('marketplace/list', 'APIController@marketplace_list');
  Route::post('marketplace/detail', 'APIController@marketplace_detail');
  Route::get('marketplace/category/list', 'APIController@list_category');
  Route::get('marketplace/category/{id}', 'APIController@get_category');
});

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
