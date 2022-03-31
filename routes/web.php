<?php

use App\Http\Controllers\NFTController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::get('/type/create', function() {
    return view('type.create');
});

// Create methods
Route::get('/users/create', [UserController::class, 'create']);  // TODO: Inside the group API it doesn't work, why?
Route::get('/collection/create', [CollectionController::class, 'create']);


Route::group(['prefix' => 'api'], function () {

    //NFTS
    Route::get('/nfts/{nft}', [NFTController::class, 'get']);
    Route::get('/nfts', [NFTController::class, 'getAll']);

    Route::get('/nfts/create', [UserController::class, 'create']);
    //Route::post('/nfts', [NFTController::class, 'create']);

    Route::delete('/nfts/{nft}', [NFTController::class, 'delete']);
    Route::put('/nfts/{nft}', [NFTController::class, 'update']); //TODO: this one :)

    //User
    Route::get('/users/{user}',  [UserController::class, 'get']);
    Route::get('/users', [UserController::class, 'getAll']);

    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store'])->name('user.store');

    Route::delete('/users/{user}', [UserController::class, 'delete']);
    Route::put('/users/{user}', [UserController::class, 'update']); //TODO: this one :)

    //Collection
    Route::get('/collections/{collection}',  [CollectionController::class, 'get'])->name('collection.getOne');
    Route::get('/collections', [CollectionController::class, 'getAll'])->name('collection.getAll');
    Route::post('/collections', [CollectionController::class, 'create']);
    Route::delete('/collections/{collection}', [CollectionController::class, 'delete']);

    //Type
    Route::get('/types/{type}',  [TypeController::class, 'get'])->name('type.getOne');
    Route::get('/types', [TypeController::class, 'getAll'])->name('type.getAll');
    Route::post('/types', [TypeController::class, 'create']);
    Route::delete('/types/{type}', [TypeController::class, 'delete']);

    //Artist
    Route::get('/artists/{artist}', [ArtistController::class, 'get']);
    Route::get('/artists', [ArtistController::class, 'getAll']);
    Route::post('/artists', [ArtistController::class, 'create']);
    Route::delete('/artists/{artist}', [ArtistController::class, 'delete']);
    Route::put('/artists/{artist}', [ArtistController::class, 'update']); //TODO: this one :)

});
