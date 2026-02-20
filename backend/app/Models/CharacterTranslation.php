<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterTranslation extends Model
{
    protected $fillable = [
        'character_id',
        'language_id',
        'name',
        'title',
        'description',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
