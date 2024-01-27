<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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



Route::any('index',[StudentController::class,'studendForm'])->name('index');;
Route::get('all_student',[StudentController::class,'studendAll']);
Route::any('storedata',[StudentController::class,'storedata'])->name('storeData');
Route::get('edit/{id}',[StudentController::class,'editdata']);
Route::get('delete/{id}',[StudentController::class,'deletedata']);
Route::post('updatedata',[StudentController::class,'updatedata']);
