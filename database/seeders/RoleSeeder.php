<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder {

    public function run() {
        $role = Role::create(['name' => 'Superadmin']);
        $role->givePermissionTo('superadmin');
    }

}
