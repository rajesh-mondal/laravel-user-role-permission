<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
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

    public function createRole( Request $request ) {
        $data = $request->validate( [
            'name'         => 'required',
            'display_name' => 'required',
            'description'  => 'required',
        ] );

        Role::create( $data );
        return response()->json( ['message' => 'Role Created Successfully'] );
    }

    public function createPermission( Request $request ) {
        $data = $request->validate( [
            'name'         => 'required',
            'display_name' => 'required',
            'description'  => 'required',
        ] );

        Permission::create( $data );
        return response()->json( ['message' => 'Permission Created Successfully'] );
    }

    public function assignPermissionToRole( Request $request ) {
        $data = $request->validate( [
            'role'       => 'required',
            'permission' => 'required',
        ] );

        $role = Role::where( 'name', $data['role'] )->first();
        $role->givePermission( $data['permission'] );

        return response()->json( ['message' => 'Assign Pemission to Role Successfully'] );
    }

    public function assignRoleToUser( Request $request ) {
        $data = $request->validate( [
            'user_id' => 'required',
            'role'    => 'required',
        ] );

        $user = User::findOrFail( $data['user_id'] );
        $user->addRole( $data['role'] );

        return response()->json( ['message' => 'Assign Role to User Successfully'] );
    }

    public function loginUser( Request $request ) {
        $data = $request->validate( [
            'email'    => 'required',
            'password' => 'required',
        ] );

        if ( Auth::attempt( ['email' => $data['email'], 'password' => $data['password']] ) ) {
            return response()->json( ['message' => 'User Login Successfully'] );
        } else {
            return response()->json( ['message' => 'Invalid Credencials'] );
        }
    }
}
