<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($historyId)
    {
        // Consulta para obtener comentarios y usuarios por ID de historia
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.id', 'comments.comment', 'users.name as user_name')
            ->where('comments.history_id', $historyId)
            ->get();

        // Retorna los comentarios y usuarios en formato JSON
        return response()->json($comments);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'comment'=>'required|min:1|max:191',
            'user_id'=>'required',
            'history_id'=>'required',
        ]);

        $comment = Comment::create([
            'comment'=>$data['comment'],
            'user_id'=>$data['user_id'],
            'history_id'=>$data['history_id'],
        ]);

        if ($comment) {
            return response()->json([
                'message' => 'success',
                'data' => $comment,
            ]);
        } else {
            return response()->json([
                'message' => 'Operación exitosa',
            ]);       
        }
    }
}

