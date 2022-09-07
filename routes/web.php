<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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

Route::middleware('restriction')->group(function(){

    Route::get('/', function () {
        return view('login');
    })->name('login');
    
    
    Route::post('/login',[AuthController::class,'postlogin'])->name('postlogin');
    
    
    Route::get('/register',[AuthController::class,'showregister'])->name('register');
    Route::post('/register',[AuthController::class,'postregister'])->name('postregister');
});
Route::middleware('checkauth')->group(function () {
    Route::get('/profile',[ProfileController::class,'showprofile'])->name('showprofile');

    Route::post('/create',[ProfileController::class,'create'])->name('createpost');
    Route::post('/update',[ProfileController::class,'update'])->name('updatepost');
    Route::post('/delete',[ProfileController::class,'delete'])->name('deletepost');
    //logout
    Route::post('/logout',[ProfileController::class,'logout'])->name('logout');
    
});