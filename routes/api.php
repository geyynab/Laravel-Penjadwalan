<?php

namespace App\Http\Controllers;
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


Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[LoginController::class,'login']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['auth:api']], function(){
    Route::resource('/dosen', DosenController::class);
    Route::resource('/hari', HariController::class);
    Route::resource('/jam', JamController::class);
    Route::resource('/matkul', MatkulController::class);
    Route::resource('/ruang', RuangController::class);
    Route::resource('/pengampu', PengampuController::class);  
    Route::resource('/jadwalkuliah', JadkulController::class);  
    Route::resource('/waktu-tdk-bersedia', WktTdkBersediaController::class); 
    Route::post('/logout', [LoginController::class, 'logout']); 
});