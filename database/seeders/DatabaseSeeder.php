<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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

        for ($i=0; $i < 10; $i++) { 
            $category = \App\Models\Category::create([
                'name' => $faker->sentence(2),
            ]);   

            $category->image()->create([
                'url' => $faker->imageUrl(640, 480, 'Top Parent', true),
            ]);

            $rand = rand(5, 15);
            for ($j=0; $j < $rand; $j++) { 
                $subCategory = $category->subCategories()->create([
                    'name' => $faker->sentence(),
                ]);

                $subCategory->image()->create([
                    'url' => $faker->imageUrl(640, 480, 'Second Level Categories', true),
                ]);

                for ($k=0; $k < 5; $k++) { 
                    $subSubCategory = $subCategory->subCategories()->create([
                        'name' => $faker->sentence(),
                    ]);

                    for ($l=0; $l < 100; $l++) { 
                        $hasSize = rand(0,1);
                        $product = \App\Models\Product::create([
                                    'name' => $faker->catchPhrase(),
                                    'price' => $hasSize == 1?null:rand(10,100),
                                    // 'size' => $hasSize == 1?null:rand(10,100),
                                ]);
            
                        if ($hasSize) {
                            $totalSize = rand(2,5);
                            for ($j=0; $j < $totalSize; $j++) { 
                                $size = rand(1,100);
                                $product->sizes()->create([
                                    'name' => $product->name.'Size: '.$size,
                                    'size' => $size,
                                    'price' => rand(10,100),
                                ]);
                            }
                        }

                        $image = rand(3, 10);
                        for ($m=0; $m < $image; $m++) { 
                            $product->images()->create([
                                'url' => $faker->imageUrl(640, 480, 'HandCraft', true),
                            ]);
                        }

                        $subSubCategory->products()->attach($product);
                    }

                }


            }

        }

        // for ($i=0; $i < 50; $i++) { 
        //     $hasSize = rand(0,1);
        //     $product = \App\Models\Product::create([
        //         'name' => 'Product '. $i,
        //         'price' => $hasSize == 1?null:rand(10,100),
        //         // 'size' => $hasSize == 1?null:rand(10,100),
        //     ]);

        //     if ($hasSize) {
        //         $totalSize = rand(2,5);
        //         for ($j=0; $j < $totalSize; $j++) { 
        //             $product->sizes()->create([
        //                 'size' => rand(1,100),
        //                 'price' => rand(10,100),
        //             ]);
        //         }
        //     }
        // }

    }
}
