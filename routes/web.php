<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(EmailController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/send', 'send')->name('send');
    Route::get('/{uuid}/success', 'success')->name('success');
});
