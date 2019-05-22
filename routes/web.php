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
Route::resource('emails', 'FeedbacksController');
Route::resource('forms', 'TransactionFormsController');
Route::resource('equipments', 'EquipmentsController');

//Authorization for Admin
Route::group(['middleware' => ['admin']], function()
{
    Route::match(['get', 'post'], '/admin/home', 'TransactionFormsController@adminHome');
    Route::match(['get', 'post'],'/admin/request-history', 'TransactionFormsController@reqHistory');
    Route::match(['get', 'post'],'/admin/balances', 'TransactionFormsController@adminBalances');
    Route::match(['get', 'post'],'/admin/calendar', 'TransactionFormsController@calendar');
    Route::match(['get', 'post'],'/admin/feedbacks', 'FeedbacksController@adminFeedbacks');

    Route::match(['get', 'post'],'/admin/art-tools', 'EquipmentsController@showArtEquipment');
    Route::match(['get', 'post'],'/admin/camera-equipment', 'EquipmentsController@showCamEquipment');
    Route::match(['get', 'post'],'/admin/misc-equipment', 'EquipmentsController@showMiscEquipment');
    Route::match(['get', 'post'],'/admin/gaming-equipment', 'EquipmentsController@showGameEquipment');
    Route::match(['get', 'post'],'/admin/sports-equipment', 'EquipmentsController@showSportEquipment');
    Route::match(['get', 'post'],'/admin/laptops-accessories', 'EquipmentsController@showLapEquipment');

    Route::get('/add','EquipmentsController@add');
    Route::post('/addEquipment','EquipmentsController@addEquipment'); 

    Route::get('/edit','EquipmentsController@edit');
    Route::post('/editEquipment','EquipmentsController@editEquipment'); 

    Route::get('/del','EquipmentsController@del');
    Route::post('/delEquipment','EquipmentsController@delEquipment'); 

    Route::post('/delSingleEquip','EquipmentsController@delSingleEquipment');

    Route::post('/readfeedback','FeedbacksController@read');

    Route::post('/appdectrans','TransactionFormsController@transactionApproval');

    Route::post('/clarettrans','TransactionFormsController@afterApproval');

    Route::post('/returnEquip','EquipmentsController@returnEquipment');

    Route::post('/editSingleEquip','EquipmentsController@editSingleEquipment');
    Route::post('/admin/search','EquipmentsController@searchEquipment');
    Route::post('/emailAll','FeedbacksController@emailAll');
    Route::post('/paid','TransactionFormsController@paidPenalty');
    Route::post('/addStock','EquipmentsController@addStock');
    
});

//Authorization for Student
Route::group(['middleware' => ['student']], function()
{
    Route::match(['get', 'post'],'/student/home', 'TransactionFormsController@studentHome');
    Route::match(['get', 'post'],'/student/history', 'TransactionFormsController@studentHistory');
    Route::match(['get', 'post'],'/student/calendar', 'TransactionFormsController@calendar');
    Route::match(['get', 'post'],'/student/contact', 'TransactionFormsController@studentContact');
    Route::match(['get', 'post'],'/student/faqs', 'TransactionFormsController@studentFAQ');
    Route::post('feedback','FeedbacksController@feedback');

    //Route::match(['get', 'post'],'/student/equipment', 'EquipmentsController@showArtEquipment');
    Route::match(['get', 'post'],'/student/cart', 'TransactionFormsController@cart1');
    Route::match(['get', 'post'],'/student/cart2', 'TransactionFormsController@cart2');
    Route::match(['get', 'post'],'/student/cart3', 'TransactionFormsController@cart3');

    Route::match(['get', 'post'],'/student/art-tools', 'EquipmentsController@showArtEquipment');
    Route::match(['get', 'post'],'/student/camera-equipment', 'EquipmentsController@showCamEquipment');
    Route::match(['get', 'post'],'/student/misc-equipment', 'EquipmentsController@showMiscEquipment');
    Route::match(['get', 'post'],'/student/gaming-equipment', 'EquipmentsController@showGameEquipment');
    Route::match(['get', 'post'],'/student/sports-equipment', 'EquipmentsController@showSportEquipment');
    Route::match(['get', 'post'],'/student/laptops-accessories', 'EquipmentsController@showLapEquipment');

    Route::post('/reserveEquip','EquipmentsController@reserveEquipment');
    Route::post('/submitForm','TransactionFormsController@submitForm');
    Route::post('/cancel','TransactionFormsController@cancelForm');
    Route::post('/student/search','EquipmentsController@searchEquipment');
    
});



//Authentication
Auth::routes();
