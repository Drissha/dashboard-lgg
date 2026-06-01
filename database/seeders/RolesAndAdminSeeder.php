<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndAdminSeeder extends Seeder
{
    public function run()
    {
        if (class_exists(Role::class)) {
            Role::firstOrCreate(['name'=>'admin']);
            Role::firstOrCreate(['name'=>'editor']);
        }

        // create admin user if not exists
        $u = User::firstOrCreate(
            ['email'=>'admin@example.com'],
            ['name'=>'Admin','password'=>bcrypt('password')]
        );

        if (method_exists($u,'assignRole')) {
            $u->assignRole('admin');
        }
    }
}
