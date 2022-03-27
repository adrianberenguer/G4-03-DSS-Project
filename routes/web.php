<?php

use App\Http\Controllers\NFTController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'api'], function () {

    //NFTS
    Route::get('/nfts/{nft}', [NFTController::class, 'get']);
    Route::get('/nfts', [NFTController::class, 'getAll']);
    Route::post('/nfts', [NFTController::class, 'create']);
    Route::delete('/nfts/{nft}', [NFTController::class, 'delete']);
    Route::put('/nfts/{nft}', [NFTController::class, 'update']); //TODO: this one :)

    //User
    Route::get('/users/{user}',  [UserController::class, 'get']);
    Route::get('/users', [UserController::class, 'getAll']);
    Route::post('/users', [UserController::class, 'create']);
    Route::delete('/users/{user}', [UserController::class, 'delete']);
    Route::put('/users/{user}', [UserController::class, 'update']); //TODO: this one :)

    //Collection
    Route::get('/collections/{collection}',  [CollectionController::class, 'get']);
    Route::get('/collections', [CollectionController::class, 'getAll']);
    Route::post('/collections', [CollectionController::class, 'create']);
    Route::delete('/collections/{collection}', [CollectionController::class, 'delete']);

    //Type
    Route::get('/types/{type}',  [TypeController::class, 'get']);
    Route::get('/types', [TypeController::class, 'getAll']);
    Route::post('/types', [TypeController::class, 'create']);
    Route::delete('/types/{type}', [TypeController::class, 'delete']);

});
