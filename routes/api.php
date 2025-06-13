<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/display', [StudentController::class,'display']);
Route::get('/display_raison', [StudentController::class,'display_raison']);
Route::post('/attribuer_point', [StudentController::class,'store']);
//Route::get('/filter/{id}',[StudentController::class,'filter']);