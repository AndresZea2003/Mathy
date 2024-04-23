<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/loadAudio', [ActivityController::class, 'loadAudio'])->name('loadAudio');

Route::get('level{levelNumber}/{activityNumber}', [ActivityController::class, 'showActivity']);

Route::view('/levels', 'levels')->name('levels');

Route::view('/store', 'store')->name('store');

Route::view('/coin-changer', 'coin-changer')->name('coin-changer');

Route::view('/draw-activity', 'draw-activity')->name('draw-activity');

Route::view('/drawing', 'drawing')->name('drawing');