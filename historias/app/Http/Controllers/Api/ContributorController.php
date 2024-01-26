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
                "contributor" => $contributor->contributor,
                "option_id" => $contributor->option_id,
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
            "contributor" => $contributor->contributor,
            "option_id" => $contributor->option_id,
            "created" => $contributor->created_at,
            "updated" => $contributor->updated_at
        ];

        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'contributor'=>'required|min:3|max:30',
            'option_id'=>'required|numeric|min:1',
        ]);

        $contributor = Contributor::create([
            'contributor'=>$data['contributor'],
            'option_id'=>$data['option_id'],
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
}
