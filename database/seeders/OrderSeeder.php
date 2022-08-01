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

        for ($j=0; $j < 1000000; $j++) {

            $date = $faker->dateTimeBetween('-10 year', 'now');

            $user = $users->random();

            $itemCount = rand(1,3);

            $order = $user->orders()->create();

            $totalPrice = 0;

            for ($k=0; $k < $itemCount; $k++) { 
                $products = $productsCollection->random($itemCount)->unique('id');

                foreach ($products as $product ) {
                    $quantity = rand(1,3);
                    $product->orders()->attach($order->id, [
                        'quantity' => $quantity,
                    ]);

                    $totalPrice = $totalPrice + ($product->price * $quantity);
                }

                $products =null;

            }

            $isDone = rand(0,1);
            $isCanceled = rand(0,1);

            if ($isDone == 1) {
                $order->update([
                    'done' => $date,
                    'is_paid' => $date,
                    'in_process' => $date,
                ]);
            } else 
            if ($isCanceled == 1) {
                $order->update([
                    'canceled' => $date,
                ]);
            }
            

            $order->update([
                'total' => $totalPrice,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

        }

    }
}
