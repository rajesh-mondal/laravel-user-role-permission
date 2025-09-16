<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function createUser( Request $request ) {
        $data = $request->validate( [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
        ] );

        User::create( [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make( $data['password'] ),
        ] );
        return response()->json( ['message' => 'User Created Successfully'] );
    }

    public function loginUser( Request $request ) {
        $data = $request->validate( [
            'email'    => 'required',
            'password' => 'required',
        ] );

        if ( Auth::attempt( ['email' => $data['email'], 'password' => $data['password']] ) ) {
            return response()->json( ['message' => 'User Login Successfully'] );
        } else{
            return response()->json( ['message' => 'Invalid Credencials'] );
        }
    }
}
