<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
              'username' => 'admin',
              'email' => 'sirwan.dev@gmail.com',
              'password' => Hash::make('1'),
              'role' => 'admin',
          ]);
    }
}
