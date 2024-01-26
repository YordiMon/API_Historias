<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;

class TitleController extends Controller
{
    public function list() {
        $titles = Title::all();
        $list = [];

        foreach($titles as $title) {
            $object = [
                "id" => $title->id,
                "title" => $title->title,
                "created" => $title->created_at,
                "updated" => $title->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $title = Title::where('id', '=', $id)->first();

        $object = [
            "id" => $title->id,
            "title" => $title->title,
            "created" => $title->created_at,
            "uptitled" => $title->uptitled_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'title'=>'required|min:3|max:30',
        ]);

        $title = Title::create([
            'title'=>$data['title'],
        ]);

        if ($title) {
            return response()->json([
                'message' => 'Operación exitosa',
                'data' => $title,
            ]);
        } else {
            return response()->json([
                'message' => 'Operación exitosa',
            ]);       
        }
    }
}
