<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {return view( 'welcome' );} );
Route::post( '/createUser', [UserController::class, 'createUser'] );
Route::post( '/loginUser', [UserController::class, 'loginUser'] );