<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function getBranchesByHistoryId($historyId)
    {
        $branches = Branch::where('history_id', $historyId)->get();

        return response()->json($branches);
    }

    public function create(Request $request)
    {
        $request->validate([
            'branch_title' => 'required|string',
            'branch_content' => 'required|string',
            'history_id' => 'required|exists:histories,id',
        ]);

        try {
            $branch = new Branch();
            $branch->branch_title = $request->branch_title;
            $branch->branch_content = $request->branch_content;
            $branch->history_id = $request->history_id;
            $branch->save();

            return response()->json(['mensaje' => 'Registro de rama agregado exitosamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al agregar el registro de rama: ' . $e->getMessage()], 500);
        }
    }
}
