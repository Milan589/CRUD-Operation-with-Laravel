<?php

namespace Database\Seeders;

use App\Models\Backend\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
                CategorySeeder::class
            ]);
            $this->call([
                SubcategorySeeder::class
            ]);
            $this->call([
                BrandSeeder::class
            ]);

        // $this->call([
        //     // UserSeeder::class
        //     BrandSeeder::class
        // ]);
        // \App\Models\User::factory(100)->create();
        // \App\Models\Brand::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
