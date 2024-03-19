<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\content;

class contentController extends Controller
{
    public function list() {
        $contents = content::all();
        $list = [];

        foreach($contents as $content) {
            $object = [
                "id" => $content->id,
                "content" => $content->content,
                "created" => $content->created_at,
                "updated" => $content->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $content = content::where('id', '=', $id)->first();

        $object = [
            "id" => $content->id,
            "content" => $content->content,
            "created" => $content->created_at,
            "updated" => $content->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'content'=>'required|min:3|max:999',
        ]);

        $content = content::create([
            'content'=>$data['content'],
        ]);

        if ($content) {
            return response()->json([
                'message' => 'Operación exitosa',
                'data' => $content,
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
            'content'=>'required|min:3|max:30',
        ]);

        $content = content::where('id', '=', $data['id'])->first();

        if($content) {

            $old = $content;
            $content->content = $data['content'];

            if ($content->Save()) {
    
                $object = [
                    "response" => "Éxito: registro modificado correctamente.",
                    "data" => $content,
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
