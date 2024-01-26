<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list() {
        $users = User::all();
        $list = [];

        foreach($users as $user) {
            $object = [
                "id" => $user->id,
                "user" => $user->name,
                "email" => $user->email,
                "email_verified_at" => $user->email_verified_at,
                "password" => $user->password,
                "remember_token" => $user->remember_token,
                "created" => $user->created_at,
                "updated" => $user->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $user = User::where('id', '=', $id)->first();

        $object = [
            "id" => $user->id,
            "user" => $user->name,
            "email" => $user->email,
            "email_verified_at" => $user->email_verified_at,
            "password" => $user->password,
            "remember_token" => $user->remember_token,
            "created" => $user->created_at,
            "updated" => $user->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'user'=>'required|min:18|max:30',
            'email'=>'required|min:18|max:30',
            'email_verified_at'=>'required|min:18|max:30',
            'password'=>'required|min:8|max:30',
            'remember_token'=>'required|min:18|max:30',
        ]);

        $user = User::create([
            'user'=>$data['user'],
            'email'=>$data['email'],
            'email_verified_at'=>$data['email_verified_at'],
            'password'=>$data['password'],
            'remember_token'=>$data['remember_token'],
        ]);

        if ($user) {
            return response()->json();
        } else {
            ;
        }
    }
}
