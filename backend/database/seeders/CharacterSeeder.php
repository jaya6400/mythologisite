<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hindu = DB::table('cultures')->where('slug', 'hindu')->first();
        $english = DB::table('languages')->where('code', 'en')->first();

        $characters = [
            [
                'slug' => 'shiva',
                'type' => 'god',
                'name' => 'Shiva',
                'title' => 'The Destroyer',
                'description' => 'Shiva is one of the principal deities of Hinduism, representing destruction and transformation. He is part of the Trimurti and is worshipped as Mahadeva.',
            ],
            [
                'slug' => 'vishnu',
                'type' => 'god',
                'name' => 'Vishnu',
                'title' => 'The Preserver',
                'description' => 'Vishnu is the preserver and protector of the universe, responsible for maintaining cosmic order (dharma) and appearing in various avatars.',
            ],
            [
                'slug' => 'brahma',
                'type' => 'god',
                'name' => 'Brahma',
                'title' => 'The Creator',
                'description' => 'Brahma is the creator god in Hindu mythology and a member of the Trimurti, responsible for the creation of the universe.',
            ],
        ];

        foreach ($characters as $char) {
            $characterId = DB::table('characters')->insertGetId([
                'culture_id' => $hindu->id,
                'slug' => $char['slug'],
                'type' => $char['type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('character_translations')->insert([
                'character_id' => $characterId,
                'language_id' => $english->id,
                'name' => $char['name'],
                'title' => $char['title'],
                'description' => $char['description'],
            ]);
        }
    }
}
