<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Relasi ke Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relasi ke Like (post yang di-like)
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
    }

    // Relasi ke Favorite (post yang difavoritkan)
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites')->withTimestamps();
    }

    // Relasi ke Notification
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Helper methods untuk cek role
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isAuthor()
    {
        return $this->hasRole('author');
    }
}
