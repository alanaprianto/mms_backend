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

// Frontpage
Route::get('/', 'MmsController@info');
Route::get('informasi', 'MmsController@info');
Route::get('bantuan', 'MmsController@help');;
Route::get('404', 'MmsController@notfound');
Route::get('register/ab', 'MmsController@register_ab');
Route::get('register/alb', 'MmsController@register_alb');
// KTA Tracking
Route::post('ktatrack', 'MmsController@ktatrack');
Route::get('ktatrack/{code}', 'MmsController@ktatrackcode');
// Cek Keabsahan
Route::post('rntrack', 'MmsController@rntrack');
Route::get('rntrack/{code}', 'MmsController@rntrackcode');
// Success Frame
Route::get('register/success', 'MmsController@success');
Route::get('register/successframe', 'MmsController@successframe');

// Payment *percobaan
Route::get('register1pay', 'MmsController@pay1');
Route::post('register1pay', 'MmsController@pay1store');

// Auth
Route::get('login', 'LoginController@show');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

// Register
Route::get('register/ab/frame', 'PendaftaranController@indexAbFrame'); // untuk frame pendaftaran di kadin daerah
Route::get('register/alb/frame', 'PendaftaranController@indexAlbFrame'); // untuk frame pendaftaran di kadin daerah
Route::post('registerall/{frame}', 'PendaftaranController@storeall'); // store pendaftaran anggota biasa
Route::get('register/code/{code}', 'PendaftaranController@register_code');
Route::post('register/code', 'PendaftaranController@store_code');


// Authenticated
Route::group(['middleware' => 'auth'], function() {
  // Profile
  Route::get('profile', 'ProfileController@index');
  Route::post('updateCAI/{id}', 'ProfileController@updateCAI');
  Route::post('updateCYP/{id}', 'ProfileController@updateCYP');
  Route::get('profile/indexAjax/{id}', 'ProfileController@indexAjax');
  Route::get('profile/tahapiiAjax/{id}', 'ProfileController@tahapiiAjax');
  Route::get('profile/tahapiiiAjax/{id}', 'ProfileController@tahapiiiAjax');

  // Register tahap 2
  Route::post('registerii/{idqg}', 'PendaftaranController@storeii');

  // Image
  Route::get('images/{filename}', 'ImageController@images');
  Route::get('image-upload','ImageController@imageUpload');
  Route::post('image-upload','ImageController@imageUploadPost');  
  Route::get('uploadedfiles/{filename}', 'ImageController@uploadedfiles');

  // Marketplace
  Route::post('marketplace/create_gallery/', 'MarketPlaceController@create_gallery');
  Route::post('marketplace/update_gallery/', 'MarketPlaceController@update_gallery');
  Route::post('marketplace/delete_gallery/', 'MarketPlaceController@delete_gallery');
  Route::get('marketplace/ajax/listBarang/', 'MarketPlaceController@listBarang');
  Route::get('marketplace/ajax/listJasa/', 'MarketPlaceController@listJasa');

  // Percobaan
  Route::get('percobaan', 'PercobaanController@percobaan');
    Route::get('percobaan/email_register2', 'PercobaanController@e_register2');
    Route::get('percobaan/email_register1', 'PercobaanController@e_register1');
    Route::get('percobaan/email_register', 'PercobaanController@e_register');
    Route::get('percobaan/email_success1', 'PercobaanController@e_success1');
    Route::get('percobaan/email_success', 'PercobaanController@e_success');
  Route::post('percobaan', 'PercobaanController@percobaanstore');
  Route::post('percobaan/rchatLogin', 'PercobaanController@rchatLogin');
});

// Member
Route::group(['prefix' => 'member/', 'middleware' => 'auth.role.member'], function () {
  Route::get('dashboard', 'Member\MemberController@dashboard');
  Route::get('kta', 'Member\MemberController@kta');
  Route::get('ajax/kta', 'Member\MemberController@ajaxKta');
  Route::post('ktaprint', 'Member\MemberController@ktaprint');
  Route::get('printkta', 'Member\MemberController@printkta');
  Route::get('rn', 'Member\MemberController@regnum');
  Route::get('compprof', 'Member\MemberController@compprof');
  Route::get('registerii', 'Member\MemberController@indexii');
  Route::get('completeprofile/{id}', 'Member\MemberController@completeprofile');
  // KTA
  Route::post('requestkta/', 'Member\MemberController@requestkta');
  Route::post('extkta', 'Member\MemberController@extkta');
  // Market
  Route::resource('marketplace', 'MarketPlaceController');
  // Notif
  Route::get('notif/all', 'Member\MemberNotifController@notif_all');
  Route::get('ajax/notifall', 'Member\MemberNotifController@notifAllAjax');
  Route::get('notif/{id}', 'Member\MemberNotifController@notif_show');
});

// Mms crud
Route::group(['prefix' => 'admin', 'middleware' => 'auth.role.admin'], function () {
  Route::get('dashboard', 'Admin\AdminUserController@dashboardAdmin');
  Route::post('chart/adm_donut', 'Admin\AdminChartController@adm_donut');
  Route::post('chart/adm_dblbar', 'Admin\AdminChartController@adm_dblbar');
  Route::post('chart/adm_member', 'Admin\AdminChartController@adm_member');
  Route::post('chart/adm_dynform', 'Admin\AdminChartController@adm_dynform');
  
  Route::resource('setting', 'Admin\FormSettingController');
  Route::resource('types', 'Admin\FormTypeController');
  Route::resource('rules', 'Admin\FormRulesController');
  Route::resource('question', 'Admin\FormQuestionController');
  Route::resource('question_group', 'Admin\FormQuestionGroupController');
  Route::resource('answer', 'Admin\FormAnswerController');
  Route::resource('result', 'Admin\FormResultController');
  Route::resource('user', 'Admin\AdminUserController');
  Route::resource('member', 'Admin\AdminMemberController');
  Route::get('notif/all', 'Admin\AdminNotifController@notifall');
  Route::get('notif/{id}', 'Admin\AdminNotifController@notif');
  Route::group(['prefix' => 'ajax/'], function () {
    Route::get('setting', 'Admin\FormSettingController@indexAjax');
    Route::get('types', 'Admin\FormTypeController@indexAjax');
    Route::get('rules', 'Admin\FormRulesController@indexAjax');
    Route::get('question', 'Admin\FormQuestionController@indexAjax');
    Route::get('question_group', 'Admin\FormQuestionGroupController@indexAjax');
    Route::get('answer', 'Admin\FormAnswerController@indexAjax');
    Route::get('result', 'Admin\FormResultController@indexAjax');
    Route::get('user', 'Admin\AdminUserController@indexAjax');
    Route::get('userresultAjax/{id}', 'Admin\AdminUserController@userresultAjax');
    Route::get('member', 'Admin\AdminMemberController@indexAjax');
    Route::get('memberresultAjax/{id}', 'Admin\AdminMemberController@memberresultAjax');
    Route::get('notifall', 'Admin\AdminNotifController@notifAllAjax');
    Route::get('notifresult/{id}', 'Admin\AdminNotifController@notifresultAjax');
    Route::get('notifuser/{id}', 'Admin\AdminNotifController@notifuserAjax');
    Route::get('marketplace/category', 'Admin\AdminCategoryController@indexAjax');
    Route::get('marketplace/slider', 'Admin\AdminSliderController@indexAjax');
    Route::get('marketplace/frontend', 'Admin\AdminMFrontController@indexAjax');
    Route::get('organizer/setting-', 'OrganizerSettingController@indexAjax');
    Route::get('organizer/list-', 'OrganizerListController@indexAjax');
    Route::post('marketplace/frontend/product/all/{id}', 'Admin\AdminMFrontController@api_product_all');
    Route::get('marketplace/frontend/product/{id}', 'Admin\AdminMFrontController@api_product_id');
    Route::post('marketplace/frontend/product/add', 'Admin\AdminMFrontController@func_add');
    Route::post('marketplace/frontend/product/remove', 'Admin\AdminMFrontController@func_remove');
  });
  Route::get('question/whereSetting/{id}', 'Admin\FormQuestionController@whereSetting');
  Route::get('marketplace/category_/create', 'Admin\AdminCategoryController@create');
  Route::resource('marketplace/category', 'Admin\AdminCategoryController');
  Route::get('marketplace/slider_/create', 'Admin\AdminSliderController@create');
  Route::resource('marketplace/slider', 'Admin\AdminSliderController');
  Route::get('marketplace/frontend_/create', 'Admin\AdminMFrontController@create');
  Route::get('marketplace/frontend/product/detail/{id}', 'Admin\AdminMFrontController@detail_product');
  Route::resource('marketplace/frontend', 'Admin\AdminMFrontController');

  Route::resource('organizer/setting_', 'OrganizerSettingController');
  Route::get('organizer/setting/create', 'OrganizerSettingController@create');
  Route::resource('organizer/list', 'OrganizerListController');
  Route::get('organizer/list_/create', 'OrganizerListController@create');
  Route::post('organizer/list/updateCYP/{id}', 'OrganizerListController@updateCYP');
});

// Kadin Daerah 
Route::group(['prefix' => 'daerah/', 'middleware' => 'auth.role.daerah'], function () {
  Route::get('dashboard', 'KadinDaerahController@dashboard');
  // pendaftaran
  Route::get('pendaftaran/ab', 'KadinDaerahController@pendaftaran');
  Route::get('pendaftaran/alb', 'KadinDaerahController@pendaftaran2');
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
  Route::post('member/postponekta/', 'KadinDaerahController@memberPostKta');
  Route::get('member/detail/{id}', 'KadinDaerahController@memberDetail');
  // Route::get('daerah/ajax/members/{id}', 'KadinDaerahController@ajaxMemberDetail');
  // notifikasi
  Route::get('notif/all', 'KadinDaerahController@notifall');
  Route::get('ajax/notifall', 'KadinDaerahController@notifAllAjax');
  Route::get('notif/{id}', 'KadinDaerahController@notif');
  Route::get('ajax/notifresult/{id}', 'KadinDaerahController@notifresultAjax');
  Route::get('ajax/notifuser/{id}', 'KadinDaerahController@notifuserAjax');
  // payment
  Route::get('ajax/payment/{code}', 'KadinDaerahController@paymentAjax');
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
  Route::get('ajax/notifall', 'KadinProvinsiController@notifAllAjax');
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
  Route::get('ajax/notifall', 'KadinPusatController@notifAllAjax');
  Route::get('notif/{id}', 'KadinPusatController@notif');
  Route::get('rn/list', 'KadinPusatController@rnList');
  Route::get('rn/list/{id}', 'KadinPusatController@memberDetail');
  Route::get('ajax/rn/list', 'KadinPusatController@ajaxRnList1');
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
  Route::get('dashboard', 'Alb\AlbController@dashboard');
  Route::get('kta', 'Alb\AlbController@kta');
  Route::get('rn', 'Alb\AlbController@regnum');
  Route::get('compprof', 'Alb\AlbController@compprof');
  Route::get('compprof/edit', 'Alb\AlbController@compprofEdit');
  Route::get('completeprofile', 'Alb\AlbController@completeprofile');

  // KTA
  Route::post('requestkta/', 'Alb\AlbController@requestkta');
  Route::get('ajax/kta', 'Alb\AlbController@ajaxKta');
  Route::post('extkta', 'Alb\AlbController@extkta');
  Route::post('ktaprint', 'Alb\AlbController@ktaprint');
  Route::get('printkta', 'Alb\AlbController@printkta');

  Route::resource('marketplace', 'MarketPlaceController');

  // Notif
  Route::get('notif/all', 'Alb\AlbNotifController@notif_all');
  Route::get('ajax/notifall', 'Alb\AlbNotifController@notifAllAjax');
  Route::get('notif/{id}', 'Alb\AlbNotifController@notif_show');
});

// API
Route::group(['prefix' => 'api/'], function() {
  Route::post('check_rn/{rn}', 'APIController@check_rn');
  Route::post('marketplace/list', 'APIController@marketplace_list1');
  Route::post('marketplace/detail', 'APIController@marketplace_detail');
  Route::get('marketplace/category/list', 'APIController@list_category');
  Route::get('marketplace/category/{id}', 'APIController@get_category');
});
// KBLI
Route::post('kbli/list', 'APIController@kblilist');
Route::get('kbli/list1', 'APIController@kblilist1');
// Get Territory
Route::get('ajax/listprovinsi', 'APIController@listProvinsi');
Route::get('ajax/listdaerah/{id}', 'APIController@listDaerah');

// Images to show in Marketplace
Route::get('images/product/thumbnail/{id}', 'ImageController@imageThumbProduct');
Route::get('images/product/{id}', 'ImageController@imageProduct');
Route::get('images/slider/thumbnail/{name}', 'ImageController@imageThumbSlider');
Route::get('images/slider/{name}', 'ImageController@imageSlider');

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
