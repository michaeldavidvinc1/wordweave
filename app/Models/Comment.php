<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "post_id",
        "content",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Scope untuk komentar terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
