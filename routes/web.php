<?php

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
});
Route::group(['middleware'=>'auth'],function (){
    Route::resource('videos',\App\Http\Controllers\VideoController::class);

});
//Route::get('/videos/{video}',[\App\Http\Controllers\VideoController::class,'index'])->name('videos.show');
//Route::get('/videos',[\App\Http\Controllers\VideoController::class,'index'])->name('videos.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/notification',[\App\Http\Controllers\NotificationController::class,'index'])->name('notification.index');
