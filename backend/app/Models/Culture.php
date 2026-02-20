<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Culture extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'region',
    ];

    public function translations()
    {
        return $this->hasMany(CultureTranslation::class);
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
