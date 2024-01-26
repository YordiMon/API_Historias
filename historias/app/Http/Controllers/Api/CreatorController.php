<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Creator;

class CreatorController extends Controller
{
    public function list() {
        $creators = Creator::all();
        $list = [];

        foreach($creators as $creator) {
            $object = [
                "id" => $creator->id,
                "creator" => $creator->creator,
                "account" => $creator->account,
                "created" => $creator->created_at,
                "updated" => $creator->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $creator = Creator::where('id', '=', $id)->first();

        $object = [
            "id" => $creator->id,
            "creator" => $creator->creator,
            "account" => $creator->account,
            "created" => $creator->created_at,
            "updated" => $creator->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'creator'=>'required|min:3|max:30',
            'account'=>'required|min:3|max:30',
        ]);

        $creator = Creator::create([
            'creator'=>$data['creator'],
            'account'=>$data['creator'],
        ]);

        if ($creator) {
            return response()->json([
                'message' => 'Operación exitosa',
                'data' => $creator,
            ]);
        } else {
            return response()->json([
                'message' => 'Operación exitosa',
            ]);       
        }
    }
}
