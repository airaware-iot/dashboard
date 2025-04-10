<?php

use App\Models\Data;
use App\SensorDataTypes;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
//	dd(\App\Services\DataAggregationService::getDataPointsCount(\App\AggregationOptions::HOURLY, now(), now()->subDays(2)));
	dd(Data::getMinutesAvg(SensorDataTypes::TEMPERATURE, now(), now()->subMinutes(100)));
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
