<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //generate 6 categories 
        $categories = Category::factory(count: 30)->create();

        //    GENERATE PRODUCTS for EACH USER 
        User::factory(5)
            // User relationship to Product
            ->has(
                Product::factory(count: 30)
                    // category id for each product 
                    ->state(function () use ($categories) {
                        return ['category_id' => $categories->random()->id];
                    })
            )->create(); // creates users and their associated products
    }
}
