<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Record;
use Faker\Factory as Faker;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            Record::create([
                'sensor_id' => rand(1, 10),
                'value' => $faker->randomElement([0, 1]),
                'date' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
