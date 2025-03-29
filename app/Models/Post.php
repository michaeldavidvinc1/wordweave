<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "category_id",
        "title",
        "slug",
        "content",
        "featured_image",
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    // Relasi ke User (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Comment
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // Relasi ke Like (user yang like)
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    // Relasi ke Favorite (user yang favoritkan)
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    // Relasi ke Notification
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Scope untuk post published
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope untuk post draft
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    // Helper untuk cek apakah post di-like oleh user tertentu
    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // Helper untuk cek apakah post difavoritkan oleh user tertentu
    public function isFavoritedBy(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}
