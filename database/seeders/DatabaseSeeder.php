<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Haircuts\Haircut;
use App\Models\Haircuts\HaircutCategory;
use App\Models\Haircuts\HaircutReservation;
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
        $this->command->info('Haircut categories seeded');
        foreach ($haircutCategories as $category) {
            HaircutCategory::factory()->create($category);
        }
        $this->command->info('Haircuts seeded!');
        foreach ($haircutLists as $haircut) {
            Haircut::factory()->create($haircut);
        }
        $this->command->info('Haircut reservations seeded!');
        HaircutReservation::factory(3)->create();
    }
}
