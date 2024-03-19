<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function list() {
        $genres = Genre::all();
        $list = [];

        foreach($genres as $genre) {
            $object = [
                "id" => $genre->id,
                "genres" => $genre->genres,
                "created" => $genre->created_at,
                "updated" => $genre->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $genre = Genre::where('id', '=', $id)->first();

        $object = [
            "id" => $genre->id,
            "genres" => $genre->genres,
            "created" => $genre->created_at,
            "updated" => $genre->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'genres'=>'required|min:3|max:30',
        ]);

        $genre = genre::create([
            'genres'=>$data['genres'],
        ]);

        if ($genre) {
            return response()->json([
                'message' => 'Operación exitosa',
                'data' => $genre,
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
            'genres'=>'required|min:3|max:30',
        ]);

        $genre = Genre::where('id', '=', $data['id'])->first();

        if($genre) {

            $old = $genre;
            $genre->genre = $data['genres'];

            if ($genre->Save()) {
    
                $object = [
                    "response" => "Éxito: registro modificado correctamente.",
                    "data" => $genre,
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
