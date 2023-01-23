<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // user has many orders and orders has many products and products has many orders
        User::factory(30)
            ->has(
                Order::factory(4)
                    ->hasAttached(
                        Product::factory()->count(3),
                        [
                            'total_quantity' => rand(1, 10),
                            'total_price' => rand(50, 1000),
                        ]
                    )
            )
            ->create();
        $this->call(RolesTableSeeder::class);

    }
}
