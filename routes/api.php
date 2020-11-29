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

Route::get('/list/projeto/{ong_id}', 'ProjetoController@list')->middleware('check.token');

Route::get('/startTo/projeto/{ong_id}', 'ProjetoController@startTo')->middleware('check.token');

Route::get('/started/projeto', 'ProjetoController@started')->middleware('check.token');

Route::get('/all/projeto', 'ProjetoController@all')->middleware('check.token');

Route::get('/passed/projeto', 'ProjetoController@passed')->middleware('check.token');

Route::get('/voluntario/projeto/{voluntario_id}', 'ProjetoController@listProjectsOfVoluntario')->middleware('check.token');

Route::get('/voluntario/projeto/passed/{voluntario_id}', 'ProjetoController@listProjectsOfVoluntarioPassed')->middleware('check.token');

Route::get('/voluntario/projeto/startTo/{voluntario_id}', 'ProjetoController@listProjectsOfVoluntarioStartTo')->middleware('check.token');

Route::resource('ong', OngController::class);

Route::resource('voluntario', VoluntarioController::class);

Route::resource('projeto', ProjetoController::class)->middleware('check.token');