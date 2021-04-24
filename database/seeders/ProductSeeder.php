<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Pork Bulgogi 500g',
                'price' => 330,
                'reorder_level' => 10
            ],
            [
                'name' => 'Gohyang Hamburger',
                'price' => 220,
                'reorder_level' => 10
            ],
            [
                'name' => 'Beef Bulgogi (Moksim)',
                'price' => 495,
                'reorder_level' => 10
            ],
            [
                'name' => 'Beef Costal',
                'price' => 495,
                'reorder_level' => 10
            ],
            [
                'name' => 'Beef Toshisal Steak',
                'price' => 610,
                'reorder_level' => 10
            ],
            [
                'name' => 'Pork Samgyupsal 500g',
                'price' => 364,
                'reorder_level' => 10
            ],
            [
                'name' => 'Beef Samgyupsal 500g',
                'price' => 390,
                'reorder_level' => 10
            ],
            [
                'name' => 'Chadol Bagi Brisket',
                'price' => 550,
                'reorder_level' => 10
            ],
            [
                'name' => 'Beef Bulgogi 500g',
                'price' => 330,
                'reorder_level' => 10
            ],
            [
                'name' => 'Beef Galbisal',
                'price' => 690,
                'reorder_level' => 10
            ],

        ];

        foreach ($products as $product)
        {
            Product::create($product);
        }

    }
}
