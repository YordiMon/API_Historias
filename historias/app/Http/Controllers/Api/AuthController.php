<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // Asegúrate de importar la clase Controller desde el espacio de nombres adecuado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth desde el espacio de nombres adecuado
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        
        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'profile' => $user,
            'access_token' => $accessToken,
            'message'=>'success'
        ]);
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response([
                'response'=>'Invalid Credentials',
                'message'=>'error.'
            ]);
        }
    
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'profile' => auth()->user(),
            'access_token' => $accessToken,
            'message' => 'success'
        ]);

    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
