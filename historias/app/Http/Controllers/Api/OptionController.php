<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
    public function list() {
        $options = Option::all();
        $list = [];

        foreach($options as $option) {
            $object = [
                "id" => $option->id,
                "option" => $option->option,
                "content_id" => $option->content_id,
                "created" => $option->created_at,
                "updated" => $option->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $option = Option::where('id', '=', $id)->first();

        $object = [
            "id" => $option->id,
            "option" => $option->option,
            "content_id" => $option->content_id,
            "created" => $option->created_at,
            "updated" => $option->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'option'=>'required|min:3|max:30',
            'content_id'=>'required|numeric|min:1',
        ]);

        $option = Option::create([
            'option'=>$data['option'],
        ]);

        if ($option) {
            return response()->json([
                'message' => 'Operación exitosa',
                'data' => $option,
            ]);
        } else {
            return response()->json([
                'message' => 'Operación exitosa',
            ]);       
        }
    }
}
