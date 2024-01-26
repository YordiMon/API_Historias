<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function list() {
        $genres = Genre::all();
        $list = [];

        foreach($genres as $genre) {
            $object = [
                "id" => $genre->id,
                "genre" => $genre->genre,
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
            "genre" => $genre->genre,
            "created" => $genre->created_at,
            "updated" => $genre->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'genre'=>'required|min:3|max:30',
        ]);

        $genre = Genre::create([
            'genre'=>$data['genre'],
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
}
