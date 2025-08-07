<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         AboutUs::create([
            'name' => 'My Company',
            'description' => 'We are a professional company that provides excellent services.',
            'image' => 'company-logo.jpg',
            'facebook' => 'https://facebook.com/mycompany',
            'instagram' => 'https://instagram.com/mycompany',
            'whatsapp' => '01234567890',
           
        ]);

    }
}
