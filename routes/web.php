<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('layout');
// });
Route::get("/",[HomeController::class,"index"]);

Route::prefix("files")->group(function() {
    Route::post("upload",[FileController::class,"uploadFile"]);
    Route::prefix("content")->group(function() {
        // Route::get("view",)
    });
});
