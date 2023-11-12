<?php

use App\Http\Controllers\LogMessageController;
use App\Http\Controllers\SubTaskController;
use App\Livewire\SubTask;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {

                        /* User Route */
Route::controller(UserController::class)->prefix('User')->as('user.')->group(function(){
    Route::get("/index", 'index')->name('index');
    Route::post("/Store", 'store')->name('store');
    Route::put("/update/{id}",'update')->name('update');
    Route::DELETE("/delete/{id}", 'destroy')->name('destroy');
});
                    /*  Client Route */
Route::controller(ClientController::class)->prefix('Client')->as('client.')->group(function(){
    Route::get("/index", 'index')->name('index');
    Route::post("/Store", 'store')->name('store');
    Route::put("/update/{id}",'update')->name('update');
    Route::DELETE("/delete/{id}", 'destroy')->name('destroy');
});
                    /* Task Route */
Route::controller(TaskController::class)->prefix('Task')->as('task.')->group(function(){

    Route::get("/index", 'index')->name('index');
    Route::post("/Store", 'store')->name('store');
    Route::put("/update/{id}", 'update')->name('update');

});
                  /*  SubTask Route */
Route::controller(SubTaskController::class)->prefix('SubTask')->as('sub.')->group(function(){

    Route::get("/index/{main_id}", 'index')->name('index');
    Route::post("/Store/{main_id}", 'store')->name('store');
 //   Route::put("/update/{id}", 'update')->name('update');
    Route::post("/extend_option/{id}", 'extend_option')->name('extend_option');
    Route::put("/extend_status/{id}", 'extend_status')->name('extend_status');
    Route::put("/upload/file/{id}", 'upload_file')->name('upload_file');
    Route::get("/download/file/{id}", 'download_file')->name('download_file');
    Route::get("/status/{id}", 'status')->name('status');
});

Route::controller(LogMessageController::class)->prefix('log_message')->as('log_message.')->group(function(){

    Route::get("/notify/{id}", 'notify')->name('notify');
});



});
