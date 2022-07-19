<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();
        $productsCollection = Product::whereNotNull('price')->get();

        foreach ($users as $index => $user) {
            $orderCount = rand(1,5);

            for ($i=0; $i < $orderCount; $i++) { 
                $itemCount = rand(1,3);

                $order = $user->orders()->create();

                $totalPrice = 0;

                for ($j=0; $j < $itemCount; $j++) { 
                    $products = $productsCollection->random($itemCount);

                    foreach ($products as $product ) {
                        $quantity = rand(1,3);
                        $order->products()->attach($product->id, [
                            'quantity' => $quantity,
                        ]);
    
                        $totalPrice = $totalPrice + ($product->price * $quantity);
                    }

                }

                $order->update([
                    'total' => $totalPrice,
                ]);

            }
        }

    }
}
