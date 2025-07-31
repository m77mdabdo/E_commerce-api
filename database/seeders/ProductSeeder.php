<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Product::create([
            "name" => "opp",
            "desc" => "this is mobile oop",
            "price" => 10000,
            "image" => "3.jpeg",
            "quantity" => 6,
            "category_id" => 12

        ]);
        Product::create([
            "name" => "iphon",
            "desc" => "this is mobile Iphon",
            "price" => 100000,
            "image" => "5.jpeg",
            "quantity" => 5,
            "category_id" => 12

        ]);
        Product::create([
            "name" => "smart Tv ",
            "desc" => "this is  smart tv ",
            "price" => 14000,
            "image" => "6.jpeg",
            "quantity" => 10,
            "category_id" => 12

        ]);
        Product::create([
            "name" => "watch ",
            "desc" => "this is catch clasek",
            "price" => 10000,
            "image" => "8.jpeg",
            "quantity" => 6,
            "category_id" => 12

        ]);
    }
}
