<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $user = User::create([
            'name' => 'Houshou Admin',
            'ad_name' => 'admin.houshou',
            'phone' => '08123456789',
            'nik' => '2101001',
            'title' => 'Administrator',
            'department' => 'Enterprise IT System & Automation',
            'email' => 'admin@houshou.com',
            'password' => bcrypt('password'),
            'is_active' => true,
        ]);

        // Create Roles for Educational Website
        $adminRole = Role::create(['name' => 'Admin']);
        $teacherRole = Role::create(['name' => 'Teacher']);
        $studentRole = Role::create(['name' => 'Student']);
        

        $permissions = Permission::pluck('id', 'id')->all();

        // All roles get all permissions (can edit everything)
        $adminRole->syncPermissions($permissions);
        $teacherRole->syncPermissions($permissions);
        $studentRole->syncPermissions($permissions);
        
        // Assign Admin role to admin user
        $user->assignRole([$adminRole->id]);

        // Create Teacher User
        $user2 = User::create([
            'name' => 'Houshou Teacher',
            'ad_name' => 'teacher.houshou',
            'phone' => '08123456780',
            'nik' => '2101002',
            'title' => 'Teacher',
            'department' => 'Education',
            'email' => 'teacher@houshou.com',
            'password' => bcrypt('password'),
            'is_active' => true,
        ]);

        $user2->assignRole([$teacherRole->id]);

        // Create Student User
        $user3 = User::create([
            'name' => 'Houshou Student',
            'ad_name' => 'student.houshou',
            'phone' => '08123456781',
            'nik' => '2101003',
            'title' => 'Student',
            'department' => 'Education',
            'email' => 'student@houshou.com',
            'password' => bcrypt('password'),
            'is_active' => true,
        ]);

        $user3->assignRole([$studentRole->id]);
        

    }
}
