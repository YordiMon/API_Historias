<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saved;
use Illuminate\Support\Facades\DB;

class SaveController extends Controller
{
    public function save(Request $request)
    {
        $userId = $request->user_id;
        $historyId = $request->history_id;

        DB::beginTransaction();

        try {
            $existingSaved = Saved::where('user_id', $userId)->where('history_id', $historyId)->first();

            if ($existingSaved) {
                $existingSaved->delete();
            } else {
                Saved::create(['user_id' => $userId, 'history_id' => $historyId]);
            }

            DB::commit();

            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Error al procesar la solicitud de guardar'], 500);
        }
    }
}
