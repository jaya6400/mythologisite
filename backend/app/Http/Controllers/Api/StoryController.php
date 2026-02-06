<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller
{
    public function show(string $slug, Request $request)
    {
        $lang = $request->query('lang', 'en');

        // Story
        $story = DB::table('stories')
            ->where('slug', $slug)
            ->first();

        if (!$story) {
            return response()->json(['message' => 'Story not found'], 404);
        }

        // Language (fallback to English)
        $language = DB::table('languages')->where('code', $lang)->first()
            ?? DB::table('languages')->where('code', 'en')->first();

        // Translation
        $translation = DB::table('story_translations')
            ->where('story_id', $story->id)
            ->where('language_id', $language->id)
            ->first();

        // Linked characters
        $characters = DB::table('story_characters')
            ->join('characters', 'story_characters.character_id', '=', 'characters.id')
            ->join('character_translations', function ($join) use ($language) {
                $join->on('characters.id', '=', 'character_translations.character_id')
                     ->where('character_translations.language_id', '=', $language->id);
            })
            ->where('story_characters.story_id', $story->id)
            ->select(
                'characters.slug',
                'characters.type',
                'character_translations.name',
                'story_characters.role'
            )
            ->get();

        return response()->json([
            'slug' => $story->slug,
            'era' => $story->era,
            'title' => $translation->title ?? null,
            'summary' => $translation->summary ?? null,
            'full_text' => $translation->full_text ?? null,
            'characters' => $characters,
            'language' => $language->code,
        ]);
    }
}

