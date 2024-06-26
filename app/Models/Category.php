<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'user_id'];

    public function photos(): BelongsToMany
    {

        return $this->belongsToMany(Photo::class);

    }
    public function user() : BelongsTo
    {

        return $this->belongsTo(User::class);

    }
}
