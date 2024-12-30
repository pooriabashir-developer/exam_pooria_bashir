<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


    Route::post('product/store',[\App\Http\Controllers\ProductController::class,'product']);
    Route::post('check/product/exist',[\App\Http\Controllers\ProductController::class,'CeckProduct']);
    Route::post('check/product/otp',[\App\Http\Controllers\ProductController::class,'CheckOtpProduct']);
Route::middleware('auth:sanctum')->group( function () {
    Route::get('product/{product:id}/info',[\App\Http\Controllers\ProductController::class,'InformationProduct']);

});
