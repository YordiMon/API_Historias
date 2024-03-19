<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_id',
        'content_id',
        'genre_id',
        'date_id',
        'user_id',
    ];

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function synopsis()
    {
        return $this->belongsTo(Synopsis::class);
    }

    public function date()
    {
        return $this->belongsTo(Date::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function bins()
    {
        return $this->hasMany(Bin::class);
    }

    public function drafts()
    {
        return $this->hasMany(Draft::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    
}
