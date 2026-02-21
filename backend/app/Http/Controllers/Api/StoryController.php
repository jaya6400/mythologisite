<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\Language;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function show(string $slug, Request $request)
    {
        $langCode = $request->query('lang', 'en');

        // Get language with fallback
        $language = Language::where('code', $langCode)->first()
            ?? Language::where('code', 'en')->first();

        // Get story with translation and characters
        $story = Story::where('slug', $slug)
            ->with([
                'translations' => function($query) use ($language) {
                    $query->where('language_id', $language->id);
                },
                'characters.translations' => function($query) use ($language) {
                    $query->where('language_id', $language->id);
                }
            ])
            ->firstOrFail();

        $translation = $story->translations->first();

        // Map characters with their translation and role
        $characters = $story->characters->map(function($character) {
            $charTranslation = $character->translations->first();

            return [
                'slug' => $character->slug,
                'type' => $character->type,
                'name' => $charTranslation->name ?? null,
                'role' => $character->pivot->role,  // From pivot table
            ];
        });

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
