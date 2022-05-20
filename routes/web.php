<?php

use App\Http\Controllers\Auth\ArtistAuthController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\Logoutcontroller;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\MailController;


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

// HOME
Route::get('/', [NftController::class, 'getHome'])->name('mainPage');

//MARKETPLACE
Route::get('/marketplace', [NftController::class, 'getMarketplace'])->middleware('isauth');

//Logout
Route::get('/logout', [Logoutcontroller::class, 'perform']);

//Contact
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});


// PROFILE
Route::get('/profile', function () {
    if (!Auth::guard('custom')->check()) {
        return view('profile');
    }
    return redirect('/');
})->middleware('auth');

Route::get('/profileSettings', function () {
    return view('profileSettings');
})->middleware('auth');

/* Route::get('/add-nft', function () {
    return view('add-nft');
}); */

//For storing an image
Route::post('/store-image', [ImageUploadController::class, 'storeImage'])
    ->name('images.store');

//COLLECTIONS
//Sort by name
Route::post('/collections/sale/{collection}', [CollectionController::class, 'putOnSaleCollection'])->name('collection.sale');
Route::get('/collections/sortByName', [CollectionController::class, 'sortByName']);
Route::get('/collections/{collection}',  [CollectionController::class, 'show'])->name('collection.getOne');

// USERS
// Views
Route::get('/users/create', [UserController::class, 'create'])->middleware('admin');
Route::get('/users/create', [UserController::class, 'create'])->middleware('admin');
Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
//Sorting for users
Route::get('/users/sortByBalance', [UserController::class, 'sortByBalance']);
Route::get('/users/sortByName', [UserController::class, 'sortByName']);

// NFTS
Route::get('/expensiveNft', [NftController::class, 'getExpensive']);
Route::get('/popularNft', [NftController::class, 'getPopulars']);
//Filter depending price
Route::get('/nfts/priceFilter', [NftController::class, 'filterPrice']);
//Filter depending availability
Route::get('/nfts/available', [NftController::class, 'available']);
//Sort depending price
Route::get('/nfts/sortByPrice', [NftController::class, 'sortByPrice']);
//Sort depending exclusivity
Route::get('/nfts/sortByExclusivity', [NftController::class, 'sortByExclusivity']);
//View for bid
Route::get('/nfts/buy/{nft}', function ($id) {
    $nft = \App\Models\Nft::whereId($id)->first();

    return view('nfts.buy')->with('nft', $nft);
});
//BID
Route::post('/nfts/bid/{nft}', [NftController::class, 'bidNFT'])->name('nft.bid');
//PURCHASE
Route::post('/nfts/purchase/{nft}', [NftController::class, 'purchaseNFT'])->name('nft.purchase');
//Put on sale
Route::put('nfts/sale/{nft}', [NftController::class, 'putOnSaleNFT'])->name('nfts.sale');
Route::put('nfts/auction/{nft}', [NftController::class, 'auction'])->name('nfts.auction');
//Close bid
Route::post('nfts/close/{nft}', [NftController::class, 'closeBid'])->name('nft.close');

//ARTISTS
//Order by name
Route::get('/artists/sortByName', [ArtistController::class, 'sortByName']);
Route::get('/artists/sortByBalance', [ArtistController::class, 'sortByBalance']);
Route::get('/artists/sortByVolume', [ArtistController::class, 'sortByVolume']);

//TYPES
//Order by name
Route::get('/types/sortByExclusivity', [TypeController::class, 'sortByExclusivity']);
//Route::get('/types/sortByCount', [TypeController::class, 'sortByCount']);

// MAIL
Route::post('/suscribeNewsletter', [MailController::class, 'suscribeToNewsletter'])->name('sendMail');


// ###########
// ## CRUDS ##
// ###########
Route::group(['prefix' => 'api'], function () {

    //## NFTS ##
    Route::get('/nfts/{nft}', [NftController::class, 'get'])->name('nft.getOne')->middleware('admin');
    Route::get('/nfts', [NftController::class, 'getAll'])->name('nft.getAll')->middleware('admin');
    Route::post('/nfts', [NftController::class, 'store'])->name('nft.store')->middleware('admin');
    Route::delete('/nfts', [NftController::class, 'delete'])->name('nft.delete')->middleware('admin');
    Route::put('/nfts', [NftController::class, 'update'])->name('nft.update')->middleware('admin');

    //## User ##
    Route::get('/users/{user}',  [UserController::class, 'get'])->name('user.getOne')->middleware('admin');
    Route::get('/users', [UserController::class, 'getAll'])->name('user.getAll')->middleware('admin');
    Route::post('/users', [UserController::class, 'create'])->name('user.create')->middleware('admin');
    Route::delete('/users', [UserController::class, 'delete'])->name('user.delete')->middleware('auth');
    Route::put('/users', [UserController::class, 'update'])->name('user.update')->middleware('auth');
    Route::put('/users/addBalance', [UserController::class, 'addBalance'])->name('user.updateBalance')->middleware('auth');

    //## Collection ##
    Route::get('/collections/{collection}',  [CollectionController::class, 'get'])->name('collection.getOne')->middleware('admin');
    Route::get('/collections', [CollectionController::class, 'getAll'])->name('collection.getAll')->middleware('admin');
    Route::post('/collections', [CollectionController::class, 'store'])->name('collection.store')->middleware('admin');
    Route::delete('/collections', [CollectionController::class, 'delete'])->name('collection.delete')->middleware('admin');
    Route::put('/collections', [CollectionController::class, 'update'])->name('collection.update')->middleware('admin');

    //## Type ##
    Route::get('/types/{type}',  [TypeController::class, 'get'])->name('type.getOne')->middleware('admin');
    Route::get('/types', [TypeController::class, 'getAll'])->name('type.getAll')->middleware('admin');
    Route::post('/types', [TypeController::class, 'store'])->name('type.store')->middleware('admin');
    Route::delete('/types', [TypeController::class, 'delete'])->name('type.delete')->middleware('admin');
    Route::put('/types', [TypeController::class, 'update'])->name('type.update')->middleware('admin');

    //## Artist ##
    Route::post('/artists', [ArtistController::class, 'store'])->name('artist.store')->middleware('admin');
    Route::get('/artists/{artist}', [ArtistController::class, 'get'])->name('artist.getOne')->middleware('admin');
    Route::get('/artists', [ArtistController::class, 'getAll'])->name('artist.getAll')->middleware('admin');
    Route::delete('/artists', [ArtistController::class, 'delete'])->name('artist.delete')->middleware('isauth');
    Route::delete('/artists/delete', [ArtistController::class, 'deleteArtist'])->name('artist.deleteProfile')->middleware('artist');
    Route::put('/artists', [ArtistController::class, 'update'])->name('artist.update')->middleware('isauth');  // ISAUTH Comprueba que es artist o user
});

Auth::routes();

Route::get('/login/artists', [ArtistAuthController::class, 'showLoginForm']);
Route::post('/artists/login', [ArtistAuthController::class, 'login']);
Route::get('/artists/logout', [ArtistAuthController::class, 'logout']);
Route::get('/register/artists', [ArtistAuthController::class, 'showRegistrationForm']);
Route::post('/artists/register', [ArtistAuthController::class, 'register']);
Route::get('/profile/artists', [ArtistController::class, 'getProfile'])->middleware('artist');

Route::get('/profileSettings/artists', [ArtistController::class, 'getProfileSettings'])->middleware('artist');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//ARTIST ADD COLLECTION AND ADD NFT
Route::get('/profile/artists/{artist}/addCollection', [ArtistController::class, 'addCollection'])->middleware('artist');
Route::get('/profile/artists/{artist}/collections/{collection}/edit', [ArtistController::class, 'editCollection'])->middleware('artist');
Route::get('/profile/artists/{artist}/collections/{collection}/edit/addNft', [ArtistController::class, 'addNft'])->middleware('artist');
