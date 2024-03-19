<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_title',
        'branch_content',
        'history_id',
    ];

    public function history()
    {
        return $this->belongsTo(History::class);
    }
}
