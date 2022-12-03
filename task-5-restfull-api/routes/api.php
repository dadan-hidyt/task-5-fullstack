<?php

use App\Http\Controllers\API\Article;
use App\Http\Controllers\API\PassportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::post('login',[PassportController::class,'login'])->name('login');
    Route::middleware('auth:api')->group(function(){
        Route::get('list-all',[Article::class,'index']);
        Route::post('create',[Article::class,'store']);
        Route::get('detail/{id}',[Article::class,'detail']);
        Route::get('delete/{id}',[Article::class,'delete']);
        Route::put('update',[Article::class,'update']);
    });
});
