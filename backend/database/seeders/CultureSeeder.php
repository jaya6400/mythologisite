<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CultureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cultureId = DB::table('cultures')->insertGetId([
            'slug' => 'hindu',
            'region' => 'Indian Subcontinent',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $english = DB::table('languages')->where('code', 'en')->first();

        DB::table('culture_translations')->insert([
            'culture_id' => $cultureId,
            'language_id' => $english->id,
            'name' => 'Hindu',
            'description' => 'Hindu mythology consists of stories, deities, philosophies, and legends originating from ancient Indian texts such as the Vedas, Upanishads, Puranas, Ramayana, and Mahabharata.',
        ]);
    }
}
