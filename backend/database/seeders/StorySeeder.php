<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hindu = DB::table('cultures')->where('slug', 'hindu')->first();
        $english = DB::table('languages')->where('code', 'en')->first();

        $storyId = DB::table('stories')->insertGetId([
            'culture_id' => $hindu->id,
            'slug' => 'samudra-manthan',
            'era' => 'Satya Yuga',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('story_translations')->insert([
            'story_id' => $storyId,
            'language_id' => $english->id,
            'title' => 'Samudra Manthan',
            'summary' => 'Samudra Manthan describes the churning of the cosmic ocean by the devas and asuras to obtain Amrita, the nectar of immortality.',
            'full_text' => 'The gods and demons used Mount Mandara as the churning rod and the serpent Vasuki as the rope. During the churning, many divine objects emerged, including Kamadhenu, Lakshmi, and finally Amrita.',
        ]);
    }
}
