<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role de administrador 
        User::create([
            'name' => Str('Administrador'),
            'email' => Str('admind2023@gmail.com'),
            'password' => Hash::make('admind2024'),
        ])->assignRole(['administrador']);

        // Role de departamentos
        User::create([
            'name'=>Str('doctor'),
            'email' => Str('doctor2024@gmail.com'),
            'password'=>Hash::make('doctor2024')
        ])->assignRole(['doctor']);

        User::create([
            'name' => Str('Lalo'),
            'email' => Str('lalo2023@gmail.com'),
            'password' => Hash::make('lalo12345'),
        ])->assignRole(['doctor','administrador']);
    }
}
