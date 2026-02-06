<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
{
    public function show(string $slug, Request $request)
    {
        $lang = $request->query('lang', 'en');

        // Character
        $character = DB::table('characters')
            ->where('slug', $slug)
            ->first();

        if (!$character) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        // Language (fallback to English)
        $language = DB::table('languages')->where('code', $lang)->first()
            ?? DB::table('languages')->where('code', 'en')->first();

        // Character translation
        $translation = DB::table('character_translations')
            ->where('character_id', $character->id)
            ->where('language_id', $language->id)
            ->first();

        // Culture
        $culture = DB::table('cultures')
            ->where('id', $character->culture_id)
            ->first();

        return response()->json([
            'slug' => $character->slug,
            'type' => $character->type,
            'image_url' => $character->image_url,
            'name' => $translation->name ?? null,
            'title' => $translation->title ?? null,
            'description' => $translation->description ?? null,
            'culture' => [
                'slug' => $culture->slug,
                'region' => $culture->region,
            ],
            'language' => $language->code,
        ]);
    }

    public function index(Request $request)
    {
        $langCode = $request->query('lang', 'en');

        // Get language (fallback to English)
        $language = DB::table('languages')
            ->where('code', $langCode)
            ->first();

        if (!$language) {
            $language = DB::table('languages')
                ->where('code', 'en')
                ->first();
        }

        $characters = DB::table('characters')
            ->join(
                'character_translations',
                'characters.id',
                '=',
                'character_translations.character_id'
            )
            ->where('character_translations.language_id', $language->id)
            ->select(
                'characters.slug',
                'characters.type',
                'character_translations.name',
                'character_translations.title'
            )
            ->orderBy('character_translations.name')
            ->get();

        return response()->json($characters);
    }
}
