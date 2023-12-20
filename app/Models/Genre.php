<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $table = 'genres';

    protected $guarded = ['id'];

    public function hasBooks(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'books_have_genres', 'genre_id', 'book_id');
    }
}
