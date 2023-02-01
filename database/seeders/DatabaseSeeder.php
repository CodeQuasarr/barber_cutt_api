<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Haircuts\Haircut;
use App\Models\Haircuts\HaircutCategory;
use App\Models\Haircuts\HaircutReservation;
use App\Models\OtherProduct\CategoryProduct;
use App\Models\OtherProduct\Product;
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
        $haircutCategories = [
            [ 'name' => 'Beard', 'description' => 'Beard services' ],
            [ 'name' => 'Haircut', 'description' => 'Haircut services' ],
            [ 'name' => 'Massage', 'description' => 'Massage services' ],
        ];
        $haircutLists = [
            [
                "name" => "Coupe Brosse",
                "description" => "140 meilleures idées sur Coupe de cheveux en 2022",
                "price" => rand(19, 40),
                "haircut_category_id" => 1,
            ],
            [
                "name" => "Coupe -18 ans",
                "description" => "Coupe pour les moins de 18 ans",
                "price" => rand(19, 40),
                "haircut_category_id" => 1,
            ],
            [
                "name" => "Coupe espoir",
                "description" => "Coupe gentleman avec coiffeur en cours de validation",
                "price" => rand(19, 40),
                "haircut_category_id" => 1,
            ],
            [
                "name" => "Traçage Barbe et son protocole de soins",
                "description" => "Taille de barbe, rasage, serviettes chaudes , massage visage et nuque",
                "price" => rand(19, 40),
                "haircut_category_id" => 2,
            ],
            [
                "name" => "Rasage Traditionnel et son protocole de soins",
                "description" => "Rasage complet de la barbe , serviettes chaudes , massage visage",
                "price" => rand(19, 40),
                "haircut_category_id" => 2,
            ],
            [
                "name" => "Taille Bouc",
                "description" => "Rasage complet de la barbe",
                "price" => rand(19, 40),
                "haircut_category_id" => 2,
            ],
            [
                "name" => "On prolonge le plaisir",
                "description" => "Massage crânien, nuque",
                "price" => rand(19, 40),
                "haircut_category_id" => 3,
            ],
            [
                "name" => "Soin visage et massage",
                "description" => "Nettoyage de peau , gommage et massage",
                "price" => rand(19, 40),
                "haircut_category_id" => 3,
            ],
            [
                "name" => "Bien-être",
                "description" => "Massage crâne , épaules, nuque, mains",
                "price" => rand(19, 40),
                "haircut_category_id" => 3,
            ]
        ];
        $categoryProduct= [
            [
                "name" => "Womens Footwear",
                "description" => "Womens Footwear",
            ],
            [
                "name" => "Mens Footwear",
                "description" => "Mens Footwear",
            ],
            [
                "name" => "Womens Casualwear",
                "description" => "Womens Casualwear",
            ],
            [
                "name" => "Mens Casualwear",
                "description" => "Mens Casualwear",
            ],
            [
                "name" => "Childrens Footwear",
                "description" => "Childrens Footwear",
            ],
            [
                "name" => "Childrens Casualwear",
                "description" => "Childrens Casualwear",
            ],
            [
                "name" => "shampoing",
                "description" => "SHampoing pour cheveux",
            ]
        ];
        $products = [
            [
                "name" => "Almond Toe Court Shoes, Patent Black",
                "description" => "Almond Toe Court Shoes, Patent Black",
                "category_product_id" => 1,
                "price" => 99.00,
                "is_active" => true,
            ],
            [
                "name" => "Suede Shoes, Blue",
                "description" => "Suede Shoes, Blue",
                "category_product_id" => 1,
                "price" => 42.00,
                "is_active" => true,
            ],
            [
                "name" => "Leather Driver Saddle Loafers, Tan",
                "description" => "Leather Driver Saddle Loafers, Tan",
                "category_product_id" => 2,
                "price" => 34.00,
                "is_active" => true,
            ],
            [
                "name" => "Flip Flops, Red",
                "description" => "Flip Flops, Red",
                "category_product_id" => 2,
                "price" => 19.00,
                "is_active" => true,
            ],
            [
                "name" => "Flip Flops, Blue",
                "description" => "Flip Flops, Blue",
                "category_product_id" => 2,
                "price" => 19.00,
            ],
            [
                "name" => "Gold Button Cardigan, Black",
                "description" => "Gold Button Cardigan, Black",
                "category_product_id" => 3,
                "price" => 167.00,
                "is_active" => true,
            ],
            [
                "name" => "Cotton Shorts, Medium Red",
                "description" => "Cotton Shorts, Medium Red",
                "category_product_id" => 3,
                "price" => 30.00,
                "is_active" => true,
            ],
            [
                "name" => "Fine Stripe Short Sleeve￼Shirt, Grey",
                "description" => "Fine Stripe Short Sleeve￼Shirt, Grey",
                "category_product_id" => 4,
                "price" => 49.99,
                "is_active" => true,
            ],
            [
                "name" => "Fine Stripe Short Sleeve￼Shirt, Green",
                "description" => "Fine Stripe Short Sleeve￼Shirt, Green",
                "category_product_id" => 4,
                "price" => 49.99,
                "is_active" => true,
            ],
            [
                "name" => "Sharkskin Waistcoat, Charcoal",
                "description" => "Sharkskin Waistcoat, Charcoal",
                "category_product_id" => 5,
                "price" => 75.00,
                "is_active" => true,
            ],
            [
                "name" => "Lightweight Patch Pocket￼Blazer, Deer",
                "description" => "Lightweight Patch Pocket￼Blazer, Deer",
                "category_product_id" => 5,
                "price" => 175.50,
                "is_active" => true,
            ],
            [
                "name" => "Bird Print Dress, Black",
                "description" => "Bird Print Dress, Black",
                "category_product_id" => 6,
                "price" => 270.00,
                "is_active" => true,
            ],
            [
                "name" => "Mid Twist Cut-Out Dress, Pink",
                "description" => "Mid Twist Cut-Out Dress, Pink",
                "category_product_id" => 6,
                "price" => 540.00,
                "is_active" => true,
            ],
            [
                "name" => "Awesome product",
                "description" => "Awesome product",
                "category_product_id" => 7,
                "price" => 75.00,
                "is_active" => true,
                "image" => "https://broaer.fr/wp-content/uploads/2022/03/27a6430a-3337-47ea-8db1-362ff3186d9c.png",
            ],
            [
                "name" => "Paul Mitchell Shampooing",
                "description" => "Paul Mitchell Shampooing 300ml Tea Tree Special Shampoo",
                "category_product_id" => 7,
                "price" => 175.50,
                "is_active" => true,
                "image" => "https://www.pro-duo.fr/on/demandware.static/-/Sites-produo-master-catalog/default/dw895c7d80/images/original/0009531115740_PNG_1_2.png",
            ],
            [
                "name" => "Osmo Hair",
                "description" => "Osmo Hair Wax 100ml HIDRA",
                "category_product_id" => 7,
                "price" => 270.00,
                "is_active" => true,
                "image" => "https://www.pro-duo.fr/dw/image/v2/BBTX_PRD/on/demandware.static/-/Sites-produo-master-catalog/default/dw4010c7ba/images/original/5035832100456_PNG_1_68%20copy%20-%20Copy.png?sw=1000&sh=1000",
            ],
            [
                "name" => "Shampoing Cheveux Secset",
                "description" => "Shampoing Cheveux Secset Peau 250ml HIDRA",
                "category_product_id" => 7,
                "price" => 540.00,
                "is_active" => true,
                "image" => "https://cdn.shopify.com/s/files/1/0653/6003/6082/products/ShampoingCheveuxSecsetPeau250mlHIDRA.png?v=1658005823",
            ],
        ];

        $this->command->info('Haircut categories seeded');
        foreach ($haircutCategories as $category) {
            HaircutCategory::factory()->create($category);
        }
        $this->command->info('Haircuts seeded!');
        foreach ($haircutLists as $haircut) {
            Haircut::factory()->create($haircut);
        }
        $this->command->info('Ohter categories products seeded!');
        foreach ($categoryProduct as $category) {
            CategoryProduct::factory()->create($category);
        }
        $this->command->info('Ohter products seeded!');
        foreach ($products as $product) {
            Product::factory()->create($product);
        }

        $this->command->info('Haircut reservations seeded!');
        HaircutReservation::factory(3)->create();

    }
}
