<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BestShoot extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public function photos() : HasMany 
    {

        return $this->hasMany(Photo::class);
        
    }
}
