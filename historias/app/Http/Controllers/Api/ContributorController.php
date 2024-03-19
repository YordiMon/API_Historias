<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contributor;

class ContributorController extends Controller
{
    public function list() {
        $contributors = Contributor::all();
        $list = [];

        foreach($contributors as $contributor) {
            $object = [
                "id" => $contributor->id,
                "id_user" => $contributor->user_id,
                "created" => $contributor->created_at,
                "updated" => $contributor->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $contributor = Contributor::where('id', '=', $id)->first();

        $object = [
            "id" => $contributor->id,
            "id_user" => $contributor->id_user,
            "created" => $contributor->created_at,
            "updated" => $contributor->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'id_user'=>'required|min:1|integer',
        ]);

        $contributor = Contributor::create([
            'id_user'=>$data['id_user'],
        ]);

        if ($concontributortent) {
            return response()->json([
                'message' => 'Operación exitosa',
                'data' => $contributor,
            ]);
        } else {
            return response()->json([
                'message' => 'Operación exitosa',
            ]);       
        }
    }

    public function update(Request $request) {
        $data = $request->validate([
            'id'=>'required|integer|min:1',
            'id_user'=>'required|min:1|integer',
        ]);

        $contributor = Contributor::where('id', '=', $data['id'])->first();

        if($contributor) {

            $old = $contributor;
            $contributor->contributor = $data['id_user'];

            if ($contributor->Save()) {
    
                $object = [
                    "response" => "Éxito: registro modificado correctamente.",
                    "data" => $contributor,
                ];
    
                return response()->json($object);
            } else {
    
                $object = [
                    "response" => "Error: algo fue mal, porfavor intenta de nuevo.",
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
