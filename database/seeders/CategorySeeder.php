<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories =['Electronic','Education','Health','Food','Fashion'];
        for($i =0 ; $i<count($categories);$i++){
            DB::table('categories')->insert([
                'title'=>$categories[$i],
                'slug'=>strtolower($categories[$i]),
                'rank'=>$i+1,
                'created_by'=>1
            ]);
        }
    }
}
