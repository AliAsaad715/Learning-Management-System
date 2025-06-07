<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English'],
            ['name' => 'Spanish'],
            ['name' => 'French'],
            ['name' => 'German'],
            ['name' => 'Mandarin Chinese'],
            ['name' => 'Arabic'],
            ['name' => 'Hindi'],
            ['name' => 'Portuguese'],
            ['name' => 'Russian'],
            ['name' => 'Japanese'],
            ['name' => 'Korean'],
            ['name' => 'Italian'],
            ['name' => 'Dutch'],
            ['name' => 'Swedish'],
            ['name' => 'Turkish'],
            ['name' => 'Polish'],
            ['name' => 'Vietnamese'],
            ['name' => 'Thai'],
            ['name' => 'Persian (Farsi)'],
            ['name' => 'Urdu'],
            ['name' => 'Indonesian'],
            ['name' => 'Malay'],
            ['name' => 'Hebrew'],
            ['name' => 'Greek'],
            ['name' => 'Czech'],
            ['name' => 'Hungarian'],
            ['name' => 'Romanian'],
            ['name' => 'Danish'],
            ['name' => 'Finnish'],
            ['name' => 'Norwegian'],
            ['name' => 'Ukrainian'],
            ['name' => 'Bengali'],
            ['name' => 'Filipino (Tagalog)'],
            ['name' => 'Swahili'],
            ['name' => 'Afrikaans'],
            ['name' => 'Bulgarian'],
            ['name' => 'Croatian'],
            ['name' => 'Slovak'],
            ['name' => 'Serbian'],
            ['name' => 'Catalan'],
        ];

        foreach ($languages as $language)
            Language::create($language);
    }
}
