<?php

use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\DataController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use const App\Services\GraphSpecVisualiserService;

Route::get('/test', function() {

});

Route::view('/', 'app.overview')->name('index');
Route::get('/databaze', [DatabaseController::class, 'view'])->name('database');
Route::view('/grafy', 'app.graphs')->name('graphs');





Route::view('/testview', 'app.test')->name('test');

Route::prefix('/api/v1')->withoutMiddleware(VerifyCsrfToken::class)->group(function () {
	Route::post('/data', DataController::class)->name('data');
});

Route::get('/devices/add', [DeviceController::class, 'index']);
//Route::post('devices/add', [])



// Dashboard
// Data table
// Card view of devices
//		Single view of details
// Recommendations panel
