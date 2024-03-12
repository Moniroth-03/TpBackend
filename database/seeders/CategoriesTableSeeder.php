<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data to be inserted
        $categories = [
            [
                'name' => 'electronics',
            ],
            // Add more product data as needed
        ];

        // Insert data into the database using Eloquent
        foreach ($categories as $category) {
            Category::create($category);
        }        
    }
}
