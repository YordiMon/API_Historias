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
        '*.branch_title' => 'required|string',
        '*.branch_content' => 'required|string',
        '*.history_id' => 'required|exists:histories,id',
    ]);

    try {
        $branchesData = $request->all();

        foreach ($branchesData as $branchData) {
            $branch = new Branch();
            $branch->branch_title = $branchData['branch_title'];
            $branch->branch_content = $branchData['branch_content'];
            $branch->history_id = $branchData['history_id'];
            $branch->save();
        }

        return response()->json(['mensaje' => 'Registros de rama agregados exitosamente'], 201);
    } catch (\Exception $e) {
        return response()->json(['mensaje' => 'Error al agregar los registros de rama: ' . $e->getMessage()], 500);
    }
}

}
