<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $userId = $request->user_id;
        $historyId = $request->history_id;

        DB::beginTransaction();

        try {
            $existingLike = Like::where('user_id', $userId)->where('history_id', $historyId)->first();

            if ($existingLike) {
                $existingLike->delete();
            } else {
                Like::create(['user_id' => $userId, 'history_id' => $historyId]);
            }

            DB::commit();

            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Error al procesar la solicitud de like'], 500);
        }
    }
}
