<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'Admin Lab',
            'email'    => 'admin@lab.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Mahasiswa Contoh',
            'email'    => 'mahasiswa@lab.com',
            'password' => Hash::make('password'),
            'role'     => 'mahasiswa',
            'nim'      => '2021001001',
            'jurusan'  => 'Informatika',
        ]);
    }
}