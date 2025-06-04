<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', function () {
    return response()->json([
        ['id' => 1, 'nom' => 'Alice Martin', 'niveau' => 'L1', 'points' => 15],
        ['id' => 2, 'nom' => 'Bob Dupont', 'niveau' => 'L2', 'points' => -3],
        ['id' => 3, 'nom' => 'Claire Rabe', 'niveau' => 'L1', 'points' => 22],
        ['id' => 4, 'nom' => 'Daniel Rakoto', 'niveau' => 'L2', 'points' => -6],
        ['id' => 5, 'nom' => 'Emma Randrianasolo', 'niveau' => 'L3', 'points' => 0],
        ['id' => 6, 'nom' => 'Fanja Rasoa', 'niveau' => 'L1', 'points' => 12],
        ['id' => 7, 'nom' => 'Gabriel', 'niveau' => 'L2', 'points' => 18],
        ['id' => 8, 'nom' => 'Hery', 'niveau' => 'L3', 'points' => -10],
        ['id' => 9, 'nom' => 'Ibrahim', 'niveau' => 'L1', 'points' => 9],
        ['id' => 10, 'nom' => 'Julie', 'niveau' => 'L3', 'points' => 3],
    ]);
});

Route::get('/display', [StudentController::class,'display']);