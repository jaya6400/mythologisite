<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CultureTranslation extends Model
{
    protected $fillable = [
        'culture_id',
        'language_id',
        'name',
        'description',
    ];

    public function culture()
    {
        return $this->belongsTo(Culture::class);
    }
}
