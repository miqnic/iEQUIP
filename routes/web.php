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
    Route::match(['get', 'post'], '/admin/home', 'TransactionFormsController@adminHome');
    Route::match(['get', 'post'],'/admin/request-history', 'TransactionFormsController@reqHistory');
    Route::match(['get', 'post'],'/admin/balances', 'TransactionFormsController@adminBalances');
    Route::match(['get', 'post'],'/admin/calendar', 'TransactionFormsController@adminCalendar');
    Route::match(['get', 'post'],'/admin/feedbacks', 'PagesController@adminFeedbacks');

    Route::match(['get', 'post'],'/admin/art-tools', 'EquipmentsController@showArtEquipment');
    Route::match(['get', 'post'],'/admin/camera-equipment', 'EquipmentsController@showCamEquipment');
    Route::match(['get', 'post'],'/admin/misc-equipment', 'EquipmentsController@showMiscEquipment');
    Route::match(['get', 'post'],'/admin/gaming-equipment', 'EquipmentsController@showGameEquipment');
    Route::match(['get', 'post'],'/admin/sports-equipment', 'EquipmentsController@showSportEquipment');
    Route::match(['get', 'post'],'/admin/laptops-accessories', 'EquipmentsController@showLapEquipment');

    Route::get('add','EquipmentsController@add');
    Route::post('addEquipment','EquipmentsController@addEquipment'); 

    Route::get('edit','EquipmentsController@edit');
    Route::post('editEquipment','EquipmentsController@editEquipment'); 

    Route::get('del','EquipmentsController@del');
    Route::post('delEquipment','EquipmentsController@delEquipment'); 
});

//Authorization for Student
Route::group(['middleware' => ['student']], function()
{
    Route::match(['get', 'post'],'/student/home', 'TransactionFormsController@index');
    Route::match(['get', 'post'],'/student/history', 'TransactionFormsController@studentHistory');
    Route::match(['get', 'post'],'/student/contact', 'PagesController@studentContact');
    Route::post('feedback','EmailsController@feedback');
    //Route::match(['get', 'post'],'/student/equipment', 'EquipmentsController@showArtEquipment');
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
