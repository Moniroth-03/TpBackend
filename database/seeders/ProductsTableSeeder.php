<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Example data to be inserted
                $products = [
                    [
                        'name' => 'Product 1',
                        'category_id' => 1,
                        'pricing' => 20.99,
                        'description' => 'Description for Product 1',
                        'images' => json_encode([
                            ['url' => 'https://example.com/image1.jpg', 'alt' => 'Image 1'],
                            ['url' => 'https://example.com/image2.jpg', 'alt' => 'Image 2'],
                        ]),
                    ],
                    // Add more product data as needed
                ];
        
                // Insert data into the database using Eloquent
                foreach ($products as $product) {
                    Products::create($product);
                }        
    }
}
