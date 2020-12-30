<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::put('/api/decliner/{recId}', [App\Http\Controllers\ReclamationsController::class, 'decliner'])->name('declare.nonfondee');
Route::put('/api/setFonde/{recId}', [App\Http\Controllers\ReclamationsController::class, 'setFonde'])->name('declare.fondee');
Route::put('/api/setValidee/{recId}', [App\Http\Controllers\ReclamationsController::class, 'setValidee'])->name('declare.validee');
