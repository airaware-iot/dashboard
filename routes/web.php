<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
	dd(\App\DataTypesEnum::getValueArray());
});

Route::get('/devices/add', [DeviceController::class, 'index']);
//Route::post('devices/add', [])


Route::get('/', function () {
    return view('app.welcome');
});


// Dashboard
// Data table
// Card view of devices
//		Single view of details
// Recommendations panel
