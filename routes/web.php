<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

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

Route::group(['middleware'=> 'local.set', 'prefix'=>'{local}'], function () {
    Route::get('/', [ImageController::class, 'user']);
    Route::post('/submit-user', [ImageController::class, 'submitUser']);
});


