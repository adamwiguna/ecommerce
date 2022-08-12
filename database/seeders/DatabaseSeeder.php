<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create();
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),
            'is_super_admin' => 1,
        ]);
        \App\Models\User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            // OrderSeeder::class,
        ]);

    }
}
