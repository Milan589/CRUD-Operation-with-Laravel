<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'=> 1,
            'name'=> \Illuminate\Support\Str::random(10),
            'email'=> \Illuminate\Support\Str::random(50).'@gmail.com',
            'password'=> Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name'=> 'Milan',
            'email'=> 'milan@gmail.com',
            'password'=> Hash::make('milan'),
        ]);

    }
}
