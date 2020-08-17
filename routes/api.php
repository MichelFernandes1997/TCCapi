<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'AuthController@login');

Route::get('/me', 'AuthController@me')->middleware('check.token');

Route::post('/logout', 'AuthController@logout')->middleware('check.token');

Route::resource('ong', OngController::class);

Route::resource('voluntario', VoluntarioController::class);

Route::resource('projeto', ProjetoController::class)->middleware('check.token');