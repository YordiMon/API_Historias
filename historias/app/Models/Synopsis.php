<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synopsis extends Model
{
    use HasFactory;

    protected $fillable = ['synopsis'];
    
    public function history()
    {
        return $this->belongsTo(History::class);
    }
}
