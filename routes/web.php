<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
    return view('welcome');
});


// Phone routes
Route::group(['prefix' => 'contact/phone'], function(){
    $c = ContactController::class;
    Route::get('create/{id}', [$c, 'phonecreate']);
    Route::post('{id}', [$c, 'phonestore']);
    Route::get('edit/{id}', [$c, 'phoneedit']);
    Route::put('{id}', [$c, 'phoneupdate']);
    Route::delete('{id}', [$c, 'phonedestroy']);
});
// Email Routes
Route::group(['prefix' => 'contact/email'], function(){
    $c = ContactController::class;
    Route::get('create/{id}', [$c, 'mailcreate']);
    Route::post('{id}', [$c, 'mailstore']);
    Route::get('edit/{id}', [$c, 'mailedit']);
    Route::put('{id}', [$c, 'mailupdate']);
    Route::delete('{id}', [$c, 'maildestroy']);
});

Route::resource(
    'contact',
    ContactController::class
);


//Route::post('/contact', 'ContactController@store');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
