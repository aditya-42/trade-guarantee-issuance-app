<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GuaranteeController;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'account'],function(){
    Route::group(['middleware'=>'guest'],function(){

        Route::get('register', [AccountController::class,'register'])->name('account.register');
        Route::post('register', [AccountController::class,'processRegister'])->name('account.processRegister');

        Route::get('login', [AccountController::class,'login'])->name('account.login');
        Route::post('login', [AccountController::class,'authenticate'])->name('account.authenticate');

    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('profile', [AccountController::class,'profile'])->name('account.profile');
        Route::get('logout', [AccountController::class,'logout'])->name('account.logout');
    });

    Route::resource('guarantees', GuaranteeController::class);
    Route::post('/guarantees/{id}/approve', [GuaranteeController::class, 'approve'])->name('guarantees.approve');


   
    Route::get('/account/guarantees/upload', [GuaranteeController::class, 'showUploadForm'])->name('guarantees.upload');
    Route::post('/account/guarantees/upload', [GuaranteeController::class, 'upload'])->name('guarantees.uploadFile');
    Route::get('guarantees/list_files', [GuaranteeController::class, 'listFiles'])->name('guarantees.list_files');
    




});