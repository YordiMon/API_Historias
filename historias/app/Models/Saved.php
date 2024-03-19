<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'history_id',
    ];

    protected $table = 'saved';

    public function history()
    {
        return $this->belongsTo(History::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
