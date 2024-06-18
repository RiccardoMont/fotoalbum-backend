<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'description', 'slug', 'best_shoot_id', 'user_id', 'published'];

    public function categories() : BelongsToMany
    {

        return $this->belongsToMany(Category::class);

    }

    public function bestShoot() : BelongsTo 
    {

        return $this->belongsTo(BestShoot::class);

    }

    public function user() : BelongsTo
    {

        return $this->belongsTo(User::class);

    }

}
