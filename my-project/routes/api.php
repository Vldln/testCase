<?php

use App\Http\Controllers\GroupsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->post('/groups', 'App\Http\Controllers\GroupsController@store');
Route::middleware('auth:sanctum')->delete('/groups', 'App\Http\Controllers\GroupsController@delete');
Route::middleware('auth:sanctum')->get('/groups', 'App\Http\Controllers\GroupsController@index');
Route::middleware('auth:sanctum')->get('/groups/{id}', 'App\Http\Controllers\GroupsController@single');
Route::middleware('auth:sanctum')->post('/groups/expenses', 'App\Http\Controllers\GroupsController@expenses');

Route::middleware('auth:sanctum')->get('/options', 'SplitOptionsController@index');

Route::middleware('auth:sanctum')->post('/expenses', 'ExpensesController@index');
Route::middleware('auth:sanctum')->get('/expenses/{id}', 'ExpensesController@single');
