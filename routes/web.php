<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {return view( 'welcome' );} );
Route::post( '/createUser', [UserController::class, 'createUser'] );
Route::post( '/login', [UserController::class, 'login'] );
Route::post( '/createRole', [UserController::class, 'createRole'] );
Route::post( '/createPermission', [UserController::class, 'createPermission'] );
Route::post( '/assignPermissionToRole', [UserController::class, 'assignPermissionToRole'] );
Route::post( '/assignRoleToUser', [UserController::class, 'assignRoleToUser'] );

// Blog
Route::get( '/readBlog', [PostController::class, 'readBlog'] )->middleware( 'auth', 'permission:read-blog' );
Route::post( '/createBlog', [PostController::class, 'createBlog'] )->middleware( 'auth', 'permission:create-blog' );
Route::post( '/updateBlog/{id}', [PostController::class, 'updateBlog'] )->middleware( 'auth', 'permission:edit-blog' );
Route::post( '/deleteBlog/{id}', [PostController::class, 'deleteBlog'] )->middleware( 'auth', 'permission:delete-blog' );