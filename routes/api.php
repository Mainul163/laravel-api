<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\testController;
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

Route::resource('test', testController::class);
Route::post('/upload',[testController::class,'uploadImage']);    
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  
    
    return $request->user();
  
    
// Route::get('/test',[App\Http\Controllers\admin\testController::class,'test'] )->name('test');

});