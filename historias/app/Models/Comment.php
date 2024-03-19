<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'history_id',
    ];

    public function history()
    {
        return $this->belongsTo(History::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
