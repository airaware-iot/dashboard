<?php

use App\Http\Controllers\DataController;
use App\Models\Data;
use App\SensorDataType;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
//	dd(\App\Services\DataAggregationService::getDataPointsCount(\App\AggregationOptions::HOURLY, now(), now()->subDays(2)));
	dd(Data::getMinutesAvg(SensorDataType::TEMPERATURE, now(), now()->subMinutes(100)));
});

Route::prefix('/api/v1')->withoutMiddleware(VerifyCsrfToken::class)->group(function () {
	Route::post('/data', DataController::class)->name('data');
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
