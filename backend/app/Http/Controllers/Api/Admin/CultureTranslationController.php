<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Culture;
use App\Models\CultureTranslation;
use App\Models\Language;
use App\Http\Requests\StoreCultureTranslationRequest;

class CultureTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Culture $culture)
    {
        $translations = $culture->translations()->with('language')->get();

        return response()->json([
            'success' => true,
            'data' => $translations->map(function ($translation) {
                return [
                    'id' => $translation->id,
                    'language_code' => $translation->language->code,
                    'language_name' => $translation->language->name,
                    'name' => $translation->name,
                    'description' => $translation->description,
                    'created_at' => $translation->created_at,
                    'updated_at' => $translation->updated_at,
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCultureTranslationRequest $request, Culture $culture)
    {
        $translation = $culture->translations()->create([
            'language_id' => $request->language_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $translation->load('language');

        return response()->json([
            'success' => true,
            'message' => 'Translation created successfully',
            'data' => [
                'id' => $translation->id,
                'language_code' => $translation->language->code,
                'language_name' => $translation->language->name,
                'name' => $translation->name,
                'description' => $translation->description,
                'created_at' => $translation->created_at,
                'updated_at' => $translation->updated_at,
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
