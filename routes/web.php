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
//Landing Page (Login)
Route::get('/', 'PagesController@index');
Route::resource('emails', 'EmailsController');
Route::resource('forms', 'TransactionFormsController');
Route::resource('equipments', 'EquipmentsController');

//Authorization for Admin
Route::group(['middleware' => ['admin']], function()
{
    Route::match(['get', 'post'], '/admin/home', 'PagesController@adminHome');
    Route::match(['get', 'post'],'/admin/request-history', 'PagesController@reqHistory');
    Route::match(['get', 'post'],'/admin/balances', 'PagesController@adminBalances');
    Route::match(['get', 'post'],'/admin/calendar', 'PagesController@adminCalendar');
    Route::match(['get', 'post'],'/admin/feedbacks', 'PagesController@adminFeedbacks');

    Route::match(['get', 'post'],'/admin/art-tools', 'PagesController@adminArtEquip');
    Route::match(['get', 'post'],'/admin/camera-equipment', 'EquipmentsController@showEquipment');
    Route::match(['get', 'post'],'/admin/misc-equipment', 'PagesController@adminMiscEquip');
    Route::match(['get', 'post'],'/admin/gaming-equipment', 'PagesController@adminGameEquip');
    Route::match(['get', 'post'],'/admin/sports-equipment', 'PagesController@adminSportEquip');
    Route::match(['get', 'post'],'/admin/laptops-accessories', 'PagesController@adminLapEquip');
});

//Authorization for Student
Route::group(['middleware' => ['student']], function()
{
    Route::match(['get', 'post'],'/student/home', 'PagesController@studentHome');
    Route::match(['get', 'post'],'/student/history', 'PagesController@studentHistory');
    Route::match(['get', 'post'],'/student/contact', 'PagesController@studentContact');
    Route::post('feedback','EmailsController@feedback');
    Route::match(['get', 'post'],'/student/equipment', 'PagesController@studentEquip');
    Route::match(['get', 'post'],'/student/cart', 'PagesController@studentCart');
    Route::match(['get', 'post'],'/student/cart2', 'PagesController@studentCart2');
    Route::match(['get', 'post'],'/student/cart3', 'PagesController@studentCart3');

    Route::match(['get', 'post'],'/student/art-tools', 'EquipmentsController@showArtEquipment');
    Route::match(['get', 'post'],'/student/camera-equipment', 'EquipmentsController@showCamEquipment');
    Route::match(['get', 'post'],'/student/misc-equipment', 'EquipmentsController@showMiscEquipment');
    Route::match(['get', 'post'],'/student/gaming-equipment', 'EquipmentsController@showGameEquipment');
    Route::match(['get', 'post'],'/student/sports-equipment', 'EquipmentsController@showSportEquipment');
    Route::match(['get', 'post'],'/student/laptops-accessories', 'EquipmentsController@showLapEquipment');
});



//Authentication
Auth::routes();
