<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use App\Models\Language;
use Illuminate\Http\Request;

class CultureController extends Controller
{
    public function show(string $slug, Request $request)
    {
        $langCode = $request->query('lang', 'en');

        // Get language with fallback
        $language = Language::where('code', $langCode)->first()
            ?? Language::where('code', 'en')->first();

        // Get culture with translation
        $culture = Culture::where('slug', $slug)
            ->with(['translations' => function($query) use ($language) {
                $query->where('language_id', $language->id);
            }])
            ->firstOrFail();

        $translation = $culture->translations->first();

        return response()->json([
            'slug' => $culture->slug,
            'region' => $culture->region,
            'name' => $translation->name ?? null,
            'description' => $translation->description ?? null,
            'language' => $language->code,
        ]);
    }
}
