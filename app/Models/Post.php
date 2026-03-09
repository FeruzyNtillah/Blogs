<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title',
        'slug', 'body', 'status', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Auto-generate slug from title
    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            $post->slug = Str::slug($post->title);
        });
    }

    // Scope: only published posts
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at');
    }

    // Post belongs to a User (the author)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Post belongs to a Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Post has many Comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}