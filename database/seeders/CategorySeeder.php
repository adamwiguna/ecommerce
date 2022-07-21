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
                'url' => '',
                'sub' => [
                    [
                        'name' => 'Aboriginal Artwork',
                        'url' => '',
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
                        'url' => '',
                        'sub' => [
                            'Incense & Essential Oil'
                        ]
                    ],
                    [
                        'name' => 'Bali Airbrush Crafts',
                        'url' => '',
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
                        'url' => '',
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
                        'url' => '',
                        'sub' => [
                            'Mask'
                        ]
                    ],
                    [
                        'name' => 'Musical Intrument',
                        'url' => '',
                        'sub' => [
                            'Djembe Drums',
                            'Musical Instruments',
                            'Rain Sticks',
                        ]
                    ],
                    [
                        'name' => 'Other Handicrafts 1',
                        'url' => '',
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
                        'url' => '',
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
                        'url' => '',
                        'sub' => [
                            'Natural Leaves Photo Albums',
                            'Picture Frames',
                        ]
                    ],
                ]
            ],
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
                    $subCategory->subCategories()->create([
                        'name' => $subSub,
                    ]);
                }

            }

        }

    }
}
