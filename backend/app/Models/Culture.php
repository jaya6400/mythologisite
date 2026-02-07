<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Culture extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
    ];

    public function translations()
    {
        return $this->hasMany(CultureTranslation::class);
    }
}
