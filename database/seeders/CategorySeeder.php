<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $faker = Faker::create();

        $data = [
            [
                'name' =>'Woodcarving Natural',
                'url' => 'https://www.baliparcel.com/media/content/product_category_group/woodcarving-natural.jpg',
                'sub' => [
                    [
                        'name' => 'Animal Woodcarving',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/animal-woodcarving-mixed.jpg',
                        'sub' => [
                            'Animals Mixed Wood Carvings',
                            'Birds Wood Carvings',
                            'Cats & Friends Wood Carvings',
                            'Dolphins Wood Carvings',
                            'Dragons Wood Carvings',
                            'Elephants Wood Carvings',
                            'Horses Wood Carvings',
                            'Sea Life Wood Carvings',
                            'Turtles Wood Carvings',
                        ], 

                    ],
                    [
                        'name' => 'Home Deco Wood Natural',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Home-Deco.jpg',
                        'sub' => [
                            'Abstract Wood Crafts',
                            'Balinese Statues',
                            'Bottle Holder Wood Crafts',
                            'Box & Ashtray Wood Crafts',
                            'Masks',
                            'Parasite Wood',
                            'Walking Sticks',
                            'Wall Plaques',
                            'Wood Carvings Mixeds',
                            'Wooden Partitions',
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Home Decoration',
                'url' => 'https://www.baliparcel.com/media/content/product_category_group/home-decoration.jpg',
                'sub' => [
                    [
                        'name' => 'Animal Woodcarving Painted',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Animal-Woodcatvings-Painted.jpg',
                        'sub' => [
                            'Animals Mixed Wooden Sculptures',
                            'Birds Wooden Sculptures',
                            'Butterflies Wooden Sculptures',
                            'Cats And Friends Wooden Sculptures',
                            'Elephants Wooden Sculptures',
                            'Geckos Wooden Sculptures',
                            'Giraffes Wooden Sculptures',
                            'Sea Life Wooden Sculptures',
                            'Seahorse Wooden Sculptures',
                        ]
                    ],
                    [
                        'name' => 'Buddha Statue Crafts',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Buddha-Statue-Crafts.jpg',
                        'sub' => [
                            'Buddha Stone & Fiberglass',
                            'Buddha Wood Unpainted',
                            'Buddhas Wood Painted',
                        ]
                    ],
                    [
                        'name' => 'Dream Catchers & Windchimes',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Dream-Catchers-&-Windchimes.jpg',
                        'sub' => [
                            'Bamboo Windchimes',
                            'Dream Catchers',
                            'Hanging Mobiles',
                            'Macrame And Juju Hat',
                            'Wind Dancers',
                            'Windchimes',
                        ]
                    ],
                    [
                        'name' => 'Interior Home Decoration',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/WhatsApp%20Image%202021-05-01%20at%201_16198365883372.jpeg',
                        'sub' => [
                            'Interior Basket',
                        ]
                    ],
                    [
                        'name' => 'Lighting',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Lighting.jpg',
                        'sub' => [
                            'Candle Holders',
                            'Candles',
                            'Lamps',
                            'Resin Lamps',
                        ]
                    ],
                    [
                        'name' => 'Other Home Decoration',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Other-Home-Decoration.jpg',
                        'sub' => [
                            'Bamboo Root',
                            'Blown Glass Bowl',
                            'Christmas Decorations',
                            'Clocks',
                            'Driftwoods',
                            'Figurines',
                            'Iron Decorations',
                            'Medallions',
                            'Mirrors',
                            'Potteries',
                            'Sand Filled Safari Animals',
                            'Terracotta Pottery',
                            'Wallhanging Words',
                            'Wood Art Prints',
                            'Wooden Paintings',
                        ]
                    ],
                    [
                        'name' => 'Painting On Canvas',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Painting-on-Canvas.jpg',
                        'sub' => [
                            'Buddha Painting',
                            'Dot Art Painting',
                            'Flowers Painting',
                            'Wholesale Balinese Dance Painting',
                        ]
                    ],
                    [
                        'name' => 'Stone Carving & Sculptures',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Stone-Carving-Sculptures.jpg',
                        'sub' => [
                            'Abstracts Stone Carving',
                            'Balinese Stone Carving',
                            'Buddhas Stone Carving',
                            'Garden Lamps',
                            'Lantern Bowl',
                            'Letter Box',
                            'Limestone Stone Crafts',
                            'Pumice Stone Crafts',
                            'Relief Wall Panels',
                            'Stand Stone Carving',
                            'Stepping Stones',
                            'Wash Basins',
                            'Water Fountains',
                        ]
                    ],
                    [
                        'name' => 'Tableware',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/TableWare.jpg',
                        'sub' => [
                            'Ashtrays',
                            'Bowls',
                            'Coasters',
                            'Cutting Boards',
                            'Food Cover',
                            'Fork And Spoon',
                            'Fruit Baskets',
                            'Glas',
                            'Mixed',
                            'Placemates',
                            'Platters',
                            'Salt And Pepper Shakers',
                            'Trays',
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Handicrafts',
                'url' => 'https://www.baliparcel.com/media/content/product_category_group/handicrafts.jpg',
                'sub' => [
                    [
                        'name' => 'Aboriginal Artwork',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/aboriginal-artwork.jpg',
                        'sub' => [
                            'Boomerang Carved',
                            'Boomerang Killing & Hook',
                            'Boomerang Modern',
                            'Boomerang Returning',
                            'Boomerang Standard',
                            'Bullroarer',
                            'Clapsticks',
                            'Coaster',
                            'Didgeridoo Bamboo',
                            'Didgeridoo Wood',
                            'Dot Paintings',
                            'Terracotta Dot Painted',
                        ]
                    ],
                    [
                        'name' => 'Aromatherapy And Spa',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/aromatheraphy-spa.jpg',
                        'sub' => [
                            'Incense & Essential Oil'
                        ]
                    ],
                    [
                        'name' => 'Bali Airbrush Crafts',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Bali-Airbrush-Crafts.jpg',
                        'sub' => [
                            'Airbrush Keychain',
                            'Airbrush Magnet',
                            'Surfboard Airbrush',
                            'Surfboard Airbrush & Carvings',
                            'Surfboard Carvings',
                        ]
                    ],
                    [
                        'name' => 'Indian, Tiki And Primitive',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/tiki-indian-native-american.jpg',
                        'sub' => [
                            'Accessories',
                            'Pirates And Skulls',
                            'Stands',
                            'Statues',
                            'Tiki Bamboo',
                            'Tiki Decor',
                            'Tribal Primitive',
                            'Wallhanging',
                            'Weapon'
                        ]
                    ],
                    [
                        'name' => 'Mask',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/African-aboriginal-mask.jpg',
                        'sub' => [
                            'Mask'
                        ]
                    ],
                    [
                        'name' => 'Musical Intrument',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Musical-Intrument.jpg',
                        'sub' => [
                            'Djembe Drums',
                            'Musical Instruments',
                            'Rain Sticks',
                        ]
                    ],
                    [
                        'name' => 'Other Handicrafts 1',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Other-Handicrafts-1.jpg',
                        'sub' => [
                            'Bookmarks',
                            'Calendar',
                            'Coins Boxes',
                            'Decorative Bookends',
                            'Dried Flowers',
                            'Eye-Glass-Holders',
                            'Fridge Magnets',
                            'Jewelry Boxes',
                            'Jewelry Displays',
                            'Keyrings',
                        ]
                    ],
                    [
                        'name' => 'Other Handicrafts 2',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Other-Handicrafts-2.jpg',
                        'sub' => [
                            'Hangers',
                            'Incense Holders',
                            'Leather Puppet',
                            'Miniature Arts',
                            'Miscellaneous Crafts',
                            'Mosaic Arts',
                            'Pencil Holders',
                            'Pencils',
                            'Puzzle',
                            'Tanimar',
                        ]
                    ],
                    [
                        'name' => 'Photos',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/photo-album.jpg',
                        'sub' => [
                            'Natural Leaves Photo Albums',
                            'Picture Frames',
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Jewelry',
                'url' => 'https://www.baliparcel.com/media/content/product_category_group/jewelry.jpg',
                'sub' => [
                    [
                        'name'=> 'Bali Jewelry Bracelets',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Bali-Jewelry-Bracelets.jpg',
                        'sub' => [
                            'Bracelets - Beaded & Shell',
                            'Bracelets - Silver',
                            'Bracelets - Wooden',
                        ]
                    ],
                    [
                        'name'=> 'Bali Jewelry Earrings',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Bali-Jewelry-Earrings.jpg',
                        'sub' => [
                            'Earrings - Beaded & Shell',
                            'Earrings - Bone',
                            'Earrings - Silver',
                            'Earrings - Wooden',
                        ]
                    ],
                    [
                        'name'=> 'Bali Jewelry Necklaces',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Bali-Jewelry-Necklaces.jpg',
                        'sub' => [
                            'Necklaces - Beaded & Shell',
                            'Necklaces - Silver',
                            'Necklaces - Tassel',
                            'Necklaces - Wooden',
                        ]
                    ],
                    [
                        'name'=> 'Bali Jewelry Piercings',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Bali-Jewelry-Piercings.jpg',
                        'sub' => [
                            'Piercings - Bone',
                            'Piercings - Coconut',
                            'Piercings - Horn',
                        ]
                    ],
                    [
                        'name'=> 'Bali Jewelry Rings',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Bali-Jewelry-Rings.jpg',
                        'sub' => [
                            'Rings - Silver',
                            'Rings Beaded & Shell',
                            'Rings Wooden',
                        ]
                    ],
                    [
                        'name'=> 'Bali Jewelry Stick Earrings',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Bali-Jewelry-Stick-Earrings.jpg',
                        'sub' => [
                            'Stick Earring - Bone',
                            'Stick Earring - Horn',
                            'Stick Earring - Wooden',
                        ]
                    ],
                    [
                        'name'=> 'Other Bali Jewelry',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Other-Bali-Jewelry.jpg',
                        'sub' => [
                            'Belts - Beaded & Shell',
                            'Bross',
                            'Hair Ornaments',
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Furniture',
                'url' => 'https://www.baliparcel.com/media/content/product_category_group/furniture.jpg',
                'sub' => [
                    [
                        'name' => 'Teak Wood',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Teak-Wood.jpg',
                        'sub' => [
                            'Old Teak Furnitures',
                            'Teak Root Furnitures',
                        ]
                    ],
                    [
                        'name' => 'Suar Wood Furnitures',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Suar-Wood.jpg',
                        'sub' => [
                            'Mixed Suar Wood Fruniture',
                            'Table Dining Set',
                        ]
                    ],
                    [
                        'name' => 'Other Furnitures',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Other-Furnitures.jpg',
                        'sub' => [
                            'Bamboo Furnitures',
                            'Bananaleaf Furniture',
                            'Cabinets And CD Racks',
                            'Rattan Furnitures',
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Garments',
                'url' => 'https://www.baliparcel.com/media/content/product_category_group/garments.jpg',
                'sub' => [
                    [
                        'name' => 'Beach Hat',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/HBH010001-1_16250255015829.jpg',
                        'sub' => [
                            'Bali Beach And Sun Hat',
                        ]
                    ],
                    [
                        'name' => 'Hand Bags',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Hand-Bags.jpg',
                        'sub' => [
                            'Batik Travel Bags',
                            'Glass Mosaic Bags',
                            'Natural Bags',
                            'Shell & Beads Bags',
                        ]
                    ],
                    [
                        'name' => 'Other Garments',
                        'url' => 'https://www.baliparcel.com/media/content/product_category/Other-Garments.jpg',
                        'sub' => [
                            'Cushions',
                            'Dresses',
                            'Sandals Beach Footwear',
                            'Sarong Ties',
                            'Sarongs',
                        ]
                    ],
                ]
            ]
        ];

        foreach ($data as $dataCategory ) {
            $category = Category::create([
                'name' => $dataCategory['name'],
            ]);

            $category->image()->create([
                'url' => $dataCategory['url']
            ]);

            foreach ($dataCategory['sub'] as $sub ) {
                $subCategory = $category->subCategories()->create([
                    'name' => $sub['name'],
                ]);

                $subCategory->image()->create([
                    'url' => $sub['url']
                ]);

                foreach ($sub['sub'] as $subSub ) {
                    $subSubCategory = $subCategory->subCategories()->create([
                        'name' => $subSub,
                    ]);

                    $countProduct = rand(2,5);

                    for ($l=0; $l < $countProduct; $l++) { 
                        $product = \App\Models\Product::create([
                                    'name' => $faker->catchPhrase(),
                                    'minimum_order' => rand(5, 50)
                                ]);
            
                        $totalSize = rand(1,3);
                        for ($m=0; $m < $totalSize; $m++) { 
                            $size = rand(1,100);
                            $product->sizes()->create([
                                'name' => $product->name.'Size: '.$size,
                                'size' => $size,
                                'price' => rand(10,100),
                            ]);
                        }

                        $image = rand(2, 5);
                        for ($n=0; $n < $image; $n++) { 
                            $product->images()->create([
                                'url' => $faker->imageUrl(640, 480, 'HandCraft', true),
                            ]);
                        }

                        $subSubCategory->products()->attach($product);
                    }

                }

            }

        }

    }
}
