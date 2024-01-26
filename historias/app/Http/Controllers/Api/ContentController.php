<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    public function list() {
        $contents = Content::all();
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
        $content = Content::where('id', '=', $id)->first();

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

        $content = Content::create([
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
}
