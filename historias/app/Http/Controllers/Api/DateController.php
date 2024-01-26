<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Date;

class DateController extends Controller
{
    public function list() {
        $dates = Date::all();
        $list = [];

        foreach($dates as $date) {
            $object = [
                "id" => $date->id,
                "date" => $date->date,
                "created" => $date->created_at,
                "updated" => $date->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $date = Date::where('id', '=', $id)->first();

        $object = [
            "id" => $date->id,
            "date" => $date->date,
            "created" => $date->created_at,
            "updated" => $date->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'date'=>'required|min:10',
        ]);

        $date = Date::create([
            'date'=>$data['date'],
        ]);

        if ($date) {
            return response()->json([
                'message' => 'Operación exitosa',
                'data' => $date,
            ]);
        } else {
            return response()->json([
                'message' => 'Operación exitosa',
            ]);       
        }
    }
}
