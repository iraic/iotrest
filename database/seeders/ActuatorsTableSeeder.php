<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Actuator;
use Faker\Factory as Faker;

class ActuatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Actuator::create([
                'name' => $faker->unique()->word(),
                'type' => $faker->randomElement(['led', 'servo', 'relay']),
                'value' => $faker->randomElement([0, 1]),
            ]);
        }
    }
}
