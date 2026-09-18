<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{

    public function run(): void
    {

        $users=[

            [
                'name'=>'Administrator',
                'username'=>'admin',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'password'=>Hash::make('Admin@123')
            ],


            [
                'name'=>'Petugas Reservasi',
                'username'=>'reservasi',
                'email'=>'reservasi@gmail.com',
                'role'=>'reservasi',
                'password'=>Hash::make('Reservasi@123')
            ],


            [
                'name'=>'Petugas Retribusi',
                'username'=>'retribusi',
                'email'=>'retribusi@gmail.com',
                'role'=>'retribusi',
                'password'=>Hash::make('Retribusi@123')
            ],


            [
                'name'=>'Petugas Sewa Fasilitas',
                'username'=>'sewa',
                'email'=>'sewa@gmail.com',
                'role'=>'sewa',
                'password'=>Hash::make('Sewa@123')
            ],


            [
                'name'=>'Petugas Logistik',
                'username'=>'logistik',
                'email'=>'logistik@gmail.com',
                'role'=>'logistik',
                'password'=>Hash::make('Logistik@123')
            ]

        ];


        foreach($users as $user)
        {

            User::create($user);

        }

    }
}