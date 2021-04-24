<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $list = "Baby
Beer, Wine & Spirits
Beverages:  tea, coffee, soda, juice, Kool-Aid, hot chocolate, water, etc.
Bread & Bakery
Breakfast & Cereal
Canned Goods & Soups
Condiments/Spices & Bake
Cookies, Snacks & Candy
Dairy, Eggs & Cheese
Deli & Signature Cafe
Flowers
Frozen Foods
Produce: Fruits & Vegetables
Grains, Pasta & Sides
International Cuisine
Meat & Seafood
Miscellaneous – gift cards/wrap, batteries, etc.
Paper Products – toilet paper, paper towels, tissues, paper plates/cups, etc.
Cleaning Supplies – laundry detergent, dishwashing soap, etc.
Health & Beauty, Personal Care & Pharmacy – pharmacy items, shampoo, toothpaste
Pet Care
Pharmacy
Tobacco";
        $categories = explode("\n",$list);

        foreach ($categories as $category)
        {
            Category::create(['name' => $category]);
        }




    }
}
