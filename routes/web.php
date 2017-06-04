<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['web']], function () {
    	

});

Route::group(['middlewire' => ['auth']], function(){
	Route::get('/home', 'HomeController@index');
	Route::get('/register', 'HomeController@register');
	Route::get('/panel', 'BackendController@charts');

	Route::get('/reports', 'BackendController@reports');
	Route::post('/reportadd', 'BackendController@reportadd');
	Route::post('/ReportFilter', 'BackendController@reports');
	Route::get('/category/{categoryid}', 'BackendController@categoryinfo');

	Route::get('/charts', 'BackendController@charts');

	Route::get('/supplier', 'BackendController@supplier');
	Route::post('/addSupplier', 'BackendController@addSupplier');
	Route::get('/deleteSupplier/{supplier}', 'BackendController@deleteSupplier');
	Route::get('/supplierinfo/{supplierid}', 'BackendController@supplierinfo');
	Route::get('/dailyreport', 'BackendController@DailyReport');
	Route::post('DailyReportFilter', 'BackendController@DailyReport');
	Route::post('/addReport', 'BackendController@addReport');
	Route::post('/supplierpay/{supplier_id}', 'BackendController@supplierpay');

	Route::get('/worker', 'BackendController@worker');
	Route::post('/addworker', 'BackendController@addworker');
	Route::get('/deleteworker/{workerid}', 'BackendController@deleteworker');
	Route::get('/workerinfo/{workerid}', 'BackendController@workerinfo');
	Route::get('/workerreport', 'BackendController@workerreport');
	Route::post('/addwages', 'BackendController@addwages');
	Route::post('/workerpay/{worker_id}', 'BackendController@workerpay');
	Route::post('/WorkerReportFilter', 'BackendController@workerreport');
	Route::post('/searchworker/', 'BackendController@workersearch');

	Route::get('/staff', 'BackendController@staff');
	Route::post('/addstaff', 'BackendController@addStaff');
	Route::get('/deletestaff/{staffid}', 'BackendController@deletestaff');
	Route::get('/staffreport', 'BackendController@staffreport');
	Route::post('/addStaffReport', 'BackendController@addstaffreport');
	Route::get('/staffinfo/{staffid}', 'BackendController@staffinfo');
	Route::post('/staffpay/{staffid}', 'BackendController@staffpay');
	Route::post('/staffreportfilter', 'BackendController@staffreport');

	Route::get('/gaurds', 'BackendController@gaurds');
	Route::post('/addgaurd', 'BackendController@addgaurd');
	Route::get('/deletegaurd/{gaurdid}', 'BackendController@deletegaurd');
	Route::get('/gaurdsreport', 'BackendController@gaurdsreport');
	Route::post('/addgaurdReport', 'BackendController@addgaurdreport');
	Route::post('/gaurdreportfilter', 'BackendController@gaurdsreport');
	Route::get('/gaurdinfo/{gaurdid}', 'BackendController@gaurdinfo');
	Route::post('/gaurdpay/{gaurdid}', 'BackendController@gaurdpay');
});
