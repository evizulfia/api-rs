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
        
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)->first();   //get db User data   

            if(Hash::check($password, $user->password)) {   
                return $user;
            } else {
                return array(
                    'status' => '400',
                    'message' => 'login failed, please check your email or password'
                );
            }
    }

}
