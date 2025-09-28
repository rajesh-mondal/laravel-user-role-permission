<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {return view( 'welcome' );} );
Route::post( '/createUser', [UserController::class, 'createUser'] );
Route::post( '/loginUser', [UserController::class, 'loginUser'] );
Route::post( '/createRole', [UserController::class, 'createRole'] );
Route::post( '/createPermission', [UserController::class, 'createPermission'] );
Route::post( '/assignPermissionToRole', [UserController::class, 'assignPermissionToRole'] );
Route::post( '/assignRoleToUser', [UserController::class, 'assignRoleToUser'] );