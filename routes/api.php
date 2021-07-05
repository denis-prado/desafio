<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

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

Route::group([
    'middleware' => 'bauth',

], function ($router) {
    Route::get('produtos', [ProdutoController::class, 'index']);

    Route::get('produto/{id}', [ProdutoController::class, 'show']);

    Route::post('produto', [ProdutoController::class, 'store']);

    Route::put('produto/{id}', [ProdutoController::class, 'update']);

    Route::delete('produto/{id}', [ProdutoController::class, 'destroy']);
});
