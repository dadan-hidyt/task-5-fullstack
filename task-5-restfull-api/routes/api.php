<?php

use App\Http\Controllers\API\Article;
use App\Http\Controllers\API\PassportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function(){
    Route::post('login',[PassportController::class,'login'])->name('login');
    Route::middleware('auth:api')->group(function(){
        Route::get('list-all',[Article::class,'index']);
        Route::post('create',[Article::class,'store']);
    });
});
