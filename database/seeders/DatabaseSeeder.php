<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Bee::truncate();

        Bee::factory()
            ->count(3)
            ->sequence(fn ($sequence) => ['name' => 'Queen ' . $sequence->index + 1])
            ->create();

        Bee::factory()
            ->count(5)
            ->sequence(fn ($sequence) => ['name' => 'Worker ' . $sequence->index + 1])
            ->create([
                'type' => 'worker',
                'points' => 75
            ]);

        Bee::factory()
            ->count(7)
            ->sequence(fn ($sequence) => ['name' => 'Drone ' . $sequence->index + 1])
            ->create([
                'type' => 'drone',
                'points' => 50
            ]);
    }
}
