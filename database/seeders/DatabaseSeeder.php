<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Console\Commands\UpdateRoleAndPermission;
use App\Models\Category;
use App\Models\HaircutService;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        // creation 3 categories for haircut services
        $haircutCategories = [
            [
                'name' => 'Haircut',
                'description' => 'Haircut services',
            ],
            [
                'name' => 'Beard',
                'description' => 'Beard services',
            ],
            [
                'name' => 'Massage',
                'description' => 'Massage services',
            ],
            [
                'name' => 'Shampoo',
                'description' => 'Shampoing',
            ],
            [
                'name' => 'mower',
                'description' => 'Tondeuse',
            ],
            [
                'name' => 'wig',
                'description' => 'Perruque',
            ],
        ];
        $haircutLists = [
            [
                "name" => "Coupe Brosse",
                "description" => "140 meilleures idées sur Coupe de cheveux en 2022",
                "price" => rand(19, 40),
                "category_id" => 1,
            ],
            [
                "name" => "Coupe -18 ans",
                "description" => "Coupe pour les moins de 18 ans",
                "price" => rand(19, 40),
                "category_id" => 1,
            ],
            [
                "name" => "Coupe espoir",
                "description" => "Coupe gentleman avec coiffeur en cours de validation",
                "price" => rand(19, 40),
                "category_id" => 1,
            ],
            [
                "name" => "Traçage Barbe et son protocole de soins",
                "description" => "Taille de barbe, rasage, serviettes chaudes , massage visage et nuque",
                "price" => rand(19, 40),
                "category_id" => 2,
            ],
            [
                "name" => "Rasage Traditionnel et son protocole de soins",
                "description" => "Rasage complet de la barbe , serviettes chaudes , massage visage",
                "price" => rand(19, 40),
                "category_id" => 2,
            ],
            [
                "name" => "Taille Bouc",
                "description" => "Rasage complet de la barbe",
                "price" => rand(19, 40),
                "category_id" => 2,
            ],
            [
                "name" => "On prolonge le plaisir",
                "description" => "Massage crânien, nuque",
                "price" => rand(19, 40),
                "category_id" => 3,
            ],
            [
                "name" => "Soin visage et massage",
                "description" => "Nettoyage de peau , gommage et massage",
                "price" => rand(19, 40),
                "category_id" => 3,
            ],
            [
                "name" => "Bien-être",
                "description" => "Massage crâne , épaules, nuque, mains",
                "price" => rand(19, 40),
                "category_id" => 3,
            ]
        ];

        foreach ($haircutCategories as $category) {
            Category::factory()->create($category);
        }

        foreach ($haircutLists as $haircut) {
            HaircutService::factory()->create($haircut);
        }
        // user has many orders and orders has many products and products has many orders
        User::factory(30)
            ->has(
                Order::factory(4)
                    ->hasAttached(
                        Product::factory(3),
                        [
                            'total_quantity' => rand(1, 10),
                            'total_price' => rand(50, 1000),
                        ]
                    )
            )
            ->create();
        // call php artisan command to update role and permission for all users
        \Artisan::call(UpdateRoleAndPermission::class);


        $this->call(RolesTableSeeder::class);

    }
}
