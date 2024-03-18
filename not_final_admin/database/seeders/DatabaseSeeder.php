<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email'=>'admin123@gmail.com',
        'is_admin'=>1],[
            'name'=>'Super Admin',
            'email'=>'admin123@gmail.com',
            'is_admin'=>1,
            'password'=>Hash::make('admin123')
        ]);

    }
}
