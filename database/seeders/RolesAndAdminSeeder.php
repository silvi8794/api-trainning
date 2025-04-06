<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::firstOrCreate(['name'=>'admin']);
        $roleCoach = Role::firstOrCreate(['name'=>'coach']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('admin123'),
            ]
        );

        $admin->assignRole($roleAdmin);

        $coach = User::firstOrCreate(
            ['email' => 'coach@gym.com'],
            [
                'name' => 'Coach Demo',
                'password' => bcrypt('coach123'),
            ]
        );

        $coach->assignRole($roleCoach);
    }
}
