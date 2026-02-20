<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryTranslation extends Model
{
    protected $fillable = [
        'story_id',
        'language_id',
        'title',
        'summary',
        'full_text',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
