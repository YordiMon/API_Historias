<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Title;
use App\Models\Genre;
use App\Models\Date;
use App\Models\Content;
use App\Models\User;
use App\Models\Saved;
use App\Models\Draft;
use App\Models\Branch;
use App\Models\Synopsis;

class HistoryController extends Controller
{
    public function storeDrafts(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
            'date' => 'required|date_format:Y-m-d',
            'user_id' => 'required|exists:users,id',
            'synopsis' => 'required|string',
        ]);

        try {
            \DB::beginTransaction();

            $title = Title::firstOrCreate(['title' => $request->title]);
            $content = Content::firstOrCreate(['content' => $request->content]);
            $synopsis = Synopsis::firstOrCreate(['synopsis' => $request->synopsis]);
            $date = Date::firstOrCreate(['date' => $request->date]);

            $history = new History();
            $history->title_id = $title->id;
            $history->content_id = $content->id;
            $history->genre_id = $request->genre_id;
            $history->date_id = $date->id;
            $history->user_id = $request->user_id;
            $history->synopsis_id = $synopsis->id;
            $history->save();

            $draft = new Draft();
            $draft->user_id = $request->user_id;
            $draft->history_id = $history->id;
            $draft->save();

            \DB::commit();

            return response()->json(['mensaje' => 'Historia creada y guardada como borrador exitosamente', 'history_id' => $history->id], 201);
        } catch (\Exception $e) {
            \DB::rollback();

            return response()->json(['mensaje' => 'Error al crear y guardar la historia como borrador: ' . $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
            'date' => 'required|date_format:Y-m-d',
            'user_id' => 'required|exists:users,id',
            'synopsis' => 'required|string',
        ]);

        try {
            \DB::beginTransaction();

            $title = Title::firstOrCreate(['title' => $request->title]);

            $content = Content::firstOrCreate(['content' => $request->content]);

            $synopsis = Synopsis::firstOrCreate(['synopsis' => $request->synopsis]);

            $date = Date::firstOrCreate(['date' => $request->date]);

            $history = new History();
            $history->title_id = $title->id;
            $history->content_id = $content->id;
            $history->genre_id = $request->genre_id;
            $history->date_id = $date->id;
            $history->user_id = $request->user_id;
            $history->synopsis_id = $synopsis->id;
            $history->save();

            \DB::commit();

            return response()->json(['mensaje' => 'Historia creada exitosamente'], 201);
        } catch (\Exception $e) {
            \DB::rollback();

            return response()->json(['mensaje' => 'Error al crear la historia: ' . $e->getMessage()], 500);
        }
    }

    public function list() {
        $histories = History::whereNotIn('id', function($query) {
            $query->select('history_id')->from('drafts');
        })->get();
        
        $list = [];

        foreach($histories as $history) {
            $object = [
                "id" => $history->id,
                "title" => $history->title->title,
                "synopsis" => $history->synopsis->synopsis,
                "content" => $history->content->content,
                "genre" => $history->genre->name,
                "date_" => $history->date->date,
                "user" => $history->user->name,
                "created" => $history->created_at,
                "updated" => $history->updated_at
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    public function id($id) {
        $history = History::withCount('likes', 'comments')
                          ->with('comments.user')
                          ->where('id', '=', $id)
                          ->first();
    
        $object = [
            "id" => $history->id,
            "title" => $history->title->title,
            "synopsis" => $history->synopsis->synopsis,
            "content" => $history->content->content,
            "genre" => $history->genre->name,
            "date_" => $history->date->date,
            "user" => $history->user->name,
            "created" => $history->created_at,
            "updated" => $history->updated_at,
            "likes_count" => $history->likes_count,
            "comments_count" => $history->comments_count,
            "comments" => $history->comments->map(function($comment) {
                return [
                    "id" => $comment->id,
                    "comment" => $comment->comment,
                    "user" => $comment->user->name,
                    "created_at" => $comment->created_at,
                    "updated_at" => $comment->updated_at
                ];
            })
        ];
    
        return response()->json($object);
    }
    
    public function historiesByUser($userId) {
        $histories = History::withCount('likes', 'comments')
                           ->with('comments.user')
                           ->where('user_id', '=', $userId)
                           ->whereNotIn('id', function($query) {
                                $query->select('history_id')->from('drafts');
                            })
                           ->get();
    
        $response = $histories->map(function($history) {
            return [
                "id" => $history->id,
                "title" => $history->title->title,
                "synopsis" => $history->synopsis->synopsis,
                "content" => $history->content->content,
                "genre" => $history->genre->name,
                "date_" => $history->date->date,
                "user" => $history->user->name,
                "created" => $history->created_at,
                "updated" => $history->updated_at,
                "likes_count" => $history->likes_count,
                "comments_count" => $history->comments_count,
                "comments" => $history->comments->map(function($comment) {
                    return [
                        "id" => $comment->id,
                        "comment" => $comment->comment,
                        "user" => $comment->user->name,
                        "created_at" => $comment->created_at,
                        "updated_at" => $comment->updated_at
                    ];
                })
            ];
        });
    
        return response()->json($response);
    }    

    public function searchByTitle($title) {
        $histories = History::whereHas('title', function($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            })
            ->whereNotIn('id', function($query) {
                $query->select('history_id')->from('drafts');
            })
            ->get();
    
        $response = [];
    
        foreach ($histories as $history) {
            $object = [
                "id" => $history->id,
                "title" => $history->title->title,
                "synopsis" => $history->synopsis->synopsis,
                "content" => $history->content->content,
                "genre" => $history->genre->name,
                "date_" => $history->date->date,
                "user" => $history->user->name,
                "created" => $history->created_at,
                "updated" => $history->updated_at
            ];
    
            $response[] = $object;
        }
    
        return response()->json($response);
    }
    
    
    public function historiesByUserSaved($userId) {
        $savedHistoryIds = Saved::where('user_id', $userId)->pluck('history_id');
    
        $histories = History::withCount('likes', 'comments')
                           ->with('comments.user')
                           ->whereIn('id', $savedHistoryIds)
                           ->get();
    
        $response = $histories->map(function($history) {
            return [
                "id" => $history->id,
                "title" => $history->title->title,
                "synopsis" => $history->synopsis->synopsis,
                "content" => $history->content->content,
                "genre" => $history->genre->name,
                "date_" => $history->date->date,
                "user" => $history->user->name,
                "created" => $history->created_at,
                "updated" => $history->updated_at,
                "likes_count" => $history->likes_count,
                "comments_count" => $history->comments_count,
                "comments" => $history->comments->map(function($comment) {
                    return [
                        "id" => $comment->id,
                        "comment" => $comment->comment,
                        "user" => $comment->user->name,
                        "created_at" => $comment->created_at,
                        "updated_at" => $comment->updated_at
                    ];
                })
            ];
        });
    
        return response()->json($response);
    }

    public function historiesByUserDrafts($userId) {
        $savedHistoryIds = Draft::where('user_id', $userId)->pluck('history_id');
    
        $histories = History::withCount('likes', 'comments')
                           ->with('comments.user')
                           ->whereIn('id', $savedHistoryIds) 
                           ->get();
    
        $response = $histories->map(function($history) {
            return [
                "id" => $history->id,
                "title" => $history->title->title,
                "synopsis" => $history->synopsis->synopsis,
                "content" => $history->content->content,
                "genre" => $history->genre->name,
                "date_" => $history->date->date,
                "user" => $history->user->name,
                "created" => $history->created_at,
                "updated" => $history->updated_at,
                "likes_count" => $history->likes_count,
                "comments_count" => $history->comments_count,
                "comments" => $history->comments->map(function($comment) {
                    return [
                        "id" => $comment->id,
                        "comment" => $comment->comment,
                        "user" => $comment->user->name,
                        "created_at" => $comment->created_at,
                        "updated_at" => $comment->updated_at
                    ];
                })
            ];
        });
    
        return response()->json($response);
    }

    public function searchByGenre($genre) {
        $histories = History::whereHas('genre', function($query) use ($genre) {
            $query->where('name', 'like', '%' . $genre . '%');
        })
        ->whereNotIn('id', function($query) {
            $query->select('history_id')->from('drafts');
        })
        ->get();
    
        $response = [];
    
        foreach ($histories as $history) {
            $object = [
                "id" => $history->id,
                "title" => $history->title->title,
                "synopsis" => $history->synopsis->synopsis,
                "content" => $history->content->content,
                "genre" => $history->genre->name,
                "date_" => $history->date->date,
                "user" => $history->user->name,
                "created" => $history->created_at,
                "updated" => $history->updated_at
            ];
    
            $response[] = $object;
        }
    
        return response()->json($response);
    }    

    public function deleteFromDraftsAndHistories(Request $request)
    {
        $request->validate([
            'history_id' => 'required|exists:histories,id',
        ]);

        try {
            \DB::beginTransaction();

            Draft::where('history_id', $request->history_id)->delete();

            History::where('id', $request->history_id)->delete();

            \DB::commit();

            return response()->json(['mensaje' => 'Historia y borrador eliminados exitosamente'], 200);
        } catch (\Exception $e) {
            \DB::rollback();

            return response()->json(['mensaje' => 'Error al eliminar la historia y el borrador: ' . $e->getMessage()], 500);
        }
    }
}
