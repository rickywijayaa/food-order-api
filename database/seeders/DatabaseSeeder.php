<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $username = [
            'Ricky',
            'Kevin',
            'Lenda',
            'Jenary'
        ];

        for($i=0; $i<4; $i++){
            DB::table('users')->insert([
                'name' => $username[$i],
                'email' => $username[$i] . '@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => 1
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('12345678'),
            'isAdmin' => 0
        ]);

        $category = [
            'cat1',
            'cat2',
            'cat3',
            'cat4'
        ];

        for($i=0; $i<4; $i++){
            DB::table('categories')->insert([
                'name' => $category[$i],
                'image' => 'seed'
            ]);
        }
    }
}
