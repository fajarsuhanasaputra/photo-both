<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder {

    public function run() {
        $user = User::create([
                    'name' => 'superadmin',
                    'email' => 'super@admin.com',
                    'password' => bcrypt('password')
        ]);
        $user->assignRole('Superadmin');
    }

}
