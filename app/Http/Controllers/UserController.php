<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        
        $username = $request->username;
        $password = $request->password;
        // return $request->all();
        $user = User::where('username', '=', $username)->where('password', $password)->first();   //get db User data   
        // return $user;
            if($user) {   
                return array(
                    'status' => '200',
                    'message' => 'login sukses',
                    'data' => $user
                );
            } else {
                return array(
                    'status' => '400',
                    'message' => 'login failed, please check your email or password'
                );
            }
    }

}
