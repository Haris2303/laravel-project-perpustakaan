<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    protected $table = 'admins';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'admin_id', 'id');
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'admin_id', 'id');
    }
}
