<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            Event::query()->create([
                'title' => 'Laravel Meetup',
                'description' => 'A Laravel Meetup, with a lot of fun, code and beer!',
                'city' => 'New York',
                'is_private' => false,
                'image' => 'default.jpg',
                'date' => '2024-06-07 19:00:00'
            ]);

            Event::query()->create([
                'title' => 'JavaScript Meetup',
                'description' => 'A JavaScript Meetup, with a lot of fun, code and beer!',
                'city' => 'San Francisco',
                'is_private' => false,
                'image' => 'default.jpg',
                'date' => '2024-06-07 19:00:00'
            ]);

    }
}
