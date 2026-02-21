<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Language;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function show(string $slug, Request $request)
    {
        $langCode = $request->query('lang', 'en');

        // Get language with fallback
        $language = Language::where('code', $langCode)->first()
            ?? Language::where('code', 'en')->first();

        // Get character with relationships
        $character = Character::where('slug', $slug)
            ->with(['culture', 'translations' => function($query) use ($language) {
                $query->where('language_id', $language->id);
            }])
            ->firstOrFail();

        $translation = $character->translations->first();

        return response()->json([
            'slug' => $character->slug,
            'type' => $character->type,
            'image_url' => $character->image_url,
            'name' => $translation->name ?? null,
            'title' => $translation->title ?? null,
            'description' => $translation->description ?? null,
            'culture' => [
                'slug' => $character->culture->slug,
                'region' => $character->culture->region,
            ],
            'language' => $language->code,
        ]);
    }

    public function index(Request $request)
    {
        $langCode = $request->query('lang', 'en');

        // Get language with fallback
        $language = Language::where('code', $langCode)->first()
            ?? Language::where('code', 'en')->first();

        // Get all characters with their translation for the language
        $characters = Character::with(['translations' => function($query) use ($language) {
                $query->where('language_id', $language->id);
            }])
            ->get()
            ->map(function($character) {
                $translation = $character->translations->first();

                return [
                    'slug' => $character->slug,
                    'type' => $character->type,
                    'name' => $translation->name ?? null,
                    'title' => $translation->title ?? null,
                ];
            })
            ->sortBy('name')
            ->values();

        return response()->json($characters);
    }
}
