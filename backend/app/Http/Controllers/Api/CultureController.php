<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CultureController extends Controller
{
    public function show(string $slug, Request $request)
    {
        $lang = $request->query('lang', 'en');

        $culture = DB::table('cultures')
            ->where('slug', $slug)
            ->first();

        if (!$culture) {
            return response()->json(['message' => 'Culture not found'], 404);
        }

        $language = DB::table('languages')->where('code', $lang)->first()
            ?? DB::table('languages')->where('code', 'en')->first();

        $translation = DB::table('culture_translations')
            ->where('culture_id', $culture->id)
            ->where('language_id', $language->id)
            ->first();

        return response()->json([
            'slug' => $culture->slug,
            'region' => $culture->region,
            'name' => $translation->name ?? null,
            'description' => $translation->description ?? null,
            'language' => $language->code,
        ]);
    }
}

