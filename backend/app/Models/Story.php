<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'culture_id',
        'slug',
        'era',
    ];

    public function culture()
    {
        return $this->belongsTo(Culture::class);
    }

    public function translations()
    {
        return $this->hasMany(StoryTranslation::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'story_characters')
            ->withPivot('role');
    }
}
