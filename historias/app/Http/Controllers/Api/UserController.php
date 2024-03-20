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
            "name" => $user->name,
            "bio" => $user->bio,
            "email" => $user->email,
            "email_verified_at" => $user->email_verified_at,
            "remember_token" => $user->remember_token,
            "created" => $user->created_at,
            "updated" => $user->updated_at
        ];

        return response()->json($object);
    }

    public function searchUserByName($name) {
        // Busca usuarios cuyo nombre contenga la cadena especificada
        $users = User::where('name', 'LIKE', '%' . $name . '%')->get();
    
        // Prepara la respuesta JSON
        $userList = [];
        foreach ($users as $user) {
            $userList[] = [
                "id" => $user->id,
                "name" => $user->name,
                "bio" => $user->bio,
                "email" => $user->email,
            ];
        }
    
        return response()->json($userList);
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

    public function update(Request $request) {
        $data = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'bio' => 'required',
            'password' => 'required|min:8',
        ]);
    
        if (!isset($data['id'])) {
            $object = [
                "response" => "Error: se requiere el campo 'id' para actualizar el registro.",
            ];
            return response()->json($object);
        }
    
        $user = User::find($data['id']);
    
        if($user) {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->bio = $data['bio'];
            $user->password = $data['password'];
    
            if ($user->save()) {
                $object = [
                    "response" => "Éxito: registro modificado correctamente.",
                    "data" => $user,
                ];
                return response()->json($object);
            } else {
                $object = [
                    "response" => "Error: algo salió mal, por favor inténtalo de nuevo.",
                ];
                return response()->json($object);
            }
        } else {
            $object = [
                "response" => "Error: registro no encontrado.",
            ];
            return response()->json($object);
        }
    }
    
}
