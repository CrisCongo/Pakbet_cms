<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProsperGuidesTableSeeder extends Seeder
{
    public function run(): void
    {
        $zodiacs = [
            'Rat', 'Ox', 'Tiger', 'Rabbit', 'Dragon', 'Snake',
            'Horse', 'Goat', 'Monkey', 'Rooster', 'Dog', 'Pig'
        ];

        foreach ($zodiacs as $zodiac) {
            DB::table('prosper_guides')->insert([
                'zodiacID' => $zodiac,
                'overview' => "Overview for $zodiac.",
                'career'   => "Career outlook for $zodiac.",
                'health'   => "Health advice for $zodiac.",
                'love'     => "Love forecast for $zodiac.",
                'wealth'   => "Wealth guidance for $zodiac.",
                'publish_date' => Carbon::now(),
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
