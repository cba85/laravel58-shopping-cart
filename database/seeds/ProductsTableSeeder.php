<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Product $productModel)
    {
        $products = [
            [
                'title' => 'Pied Apple',
                'slug' => 'pied-apple',
                'description' => 'Apple monitor stand',
                'price' => '999.00',
            ],
            [
                'title' => 'Macbook Pro',
                'slug' => 'macbook-pro',
                'description' => 'Macbook Pro 15"',
                'price' => '2999.00',
            ],[
                'title' => 'iPhone Xr',
                'slug' => 'iphone-xr',
                'description' => 'iPhone Xr less good than a Google Pixel 3a',
                'price' => '899.00',
            ],
        ];

        foreach ($products as $product) {
            $productModel->create([
                'title' => $product['title'],
                'slug' => $product['slug'],
                'description' => $product['description'],
                'price' => $product['price'],
                'image' => 'https://picsum.photos/500/500',
                'stock' => rand(0, 10)
            ]);
        }
    }
}
