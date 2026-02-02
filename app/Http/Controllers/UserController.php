<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->auth_user;

        return response()->json([
            'user_id' => $user->id,
            'email'   => $user->email,
            'name'    => $user->name,
            'avatar'  => $user->avatar, 
            'role'    => $user->role,
        ]);
    }
}




// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     public function index(Request $request)
//     {
//         $user = $request->auth_user;

//         return response()->json([
//             'user_id' => $user->id,
//             'email'   => $user->email,
//             'name'    => $user->name,
//             'role'    => $user->role,
//         ]);
//     }
// }
