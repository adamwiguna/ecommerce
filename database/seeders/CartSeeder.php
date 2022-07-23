<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $maxUser = 100;

        $rootproducts = Product::select('id')->whereNotNull('price')->get();

        for ($i=0; $i < $maxUser; $i++) { 
            $customer = \App\Models\User::factory()->create([
                'name' => $faker->name(),
                'email' => $faker->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $totalProducts = rand(1,10);

            $products = $rootproducts->random($totalProducts);
            
            foreach ($products as $key => $product) {
                $count = rand(1,10);
                $customer->carts()->create([
                    'product_id' => $product->id,
                    'quantity' => $count,
                ]);
            }
        }

    }
}
