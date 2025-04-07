<?php

use App\AggregationOptions;
use App\Models\Data;
use App\SensorDataTypes;
use App\Services\DataAggregationService;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
	dd(Data::getLastFortyEightHours(SensorDataTypes::TEMPERATURE));
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
