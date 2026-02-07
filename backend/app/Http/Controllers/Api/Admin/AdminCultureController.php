<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCultureController extends Controller
{
    public function index()
    {
        return Culture::latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'nullable|string|unique:cultures,slug',
        ]);

        $slug = $data['slug'] ?? Str::slug($request->input('name', uniqid()));

        $culture = Culture::create([
            'slug' => $slug,
        ]);

        return response()->json($culture, 201);
    }

    public function show($id)
    {
        return Culture::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $culture = Culture::findOrFail($id);

        $data = $request->validate([
            'slug' => 'required|string|unique:cultures,slug,' . $culture->id,
        ]);

        $culture->update($data);

        return response()->json($culture);
    }

    public function destroy($id)
    {
        $culture = Culture::findOrFail($id);
        $culture->delete();

        return response()->json(['message' => 'Culture deleted']);
    }
}
