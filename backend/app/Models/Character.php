<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'culture_id',
        'slug',
        'type',
        'image_url',
    ];

    public function culture()
    {
        return $this->belongsTo(Culture::class);
    }

    public function translations()
    {
        return $this->hasMany(CharacterTranslation::class);
    }

    public function stories()
    {
        return $this->belongsToMany(Story::class, 'story_characters')
            ->withPivot('role');
    }
}
