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
}
