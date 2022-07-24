<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories =['Book','Computer & Loptop','Mobile','Charger'];
        for($i =0 ; $i<count($subcategories);$i++){
            DB::table('categories')->insert([
                'title'=>$subcategories[$i],
                'slug'=>strtolower($subcategories[$i]),
                'rank'=>$i+1,
                'created_by'=>1
            ]);
        }
    }
}
