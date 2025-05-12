<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([

            "name" => "mobile",
            "desc" => "this is mobile ",
            "image" => "categories/2.jpg",
            "status" => 1
        ]);
        Category::create([

            "name" => "watch",
            "desc" => "this is watch ",
            "image" => "categories/1.jpeg",
            "status" => 1
        ]);
        Category::create([

            "name" => "tv",
            "desc" => "this is tv ",
            "image" => "categories/1.jpeg",
            "status" => 1
        ]);
    }
}
