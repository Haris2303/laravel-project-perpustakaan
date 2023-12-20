<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $table = 'books';

    protected $guarded = ['id'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id', 'admins');
    }

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class, 'book_id', 'id');
    }

    public function hasGenres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'books_have_genres', 'book_id', 'genre_id');
    }
}
