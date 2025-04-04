<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function blog()
    {
        return $this->belongsTo(BlogPost::class, 'blogpost_id', 'id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }
}
