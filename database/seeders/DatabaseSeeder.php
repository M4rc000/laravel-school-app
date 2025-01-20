<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'role_id' => 1, 
            'picture' => 'profile-img/default.jpeg', 
            'name' => 'Scientist', 
            'email' => 'marcoantoniomadgaskar90@gmail.com', 
            'email_verified_at' => date('Y-m-d'),
            'password' => bcrypt('12345'), 
            'is_active' => 1, 
            'remember_token' => random_int(1000, 9999),
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        
        UserRole::create([
            'role_name' => 'Administrator', 
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);

        UserRole::create([
            'role_name' => 'Lecturer', 
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);

        UserRole::create([
            'role_name' => 'Student', 
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);
        UserRole::create([
            'role_name' => 'Guest', 
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);
        
        Menu::create([
            'name' => 'Admin',
            'is_active' => 1,
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);

        Menu::create([
            'name' => 'Lecturer',
            'is_active' => 1,
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);

        Menu::create([
            'name' => 'Student',
            'is_active' => 1,
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);

        Menu::create([
            'name' => 'User',
            'is_active' => 1,
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);
        
        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Dashboard',
            'url' => 'admin/dashboard',
            'icon' => 'bx bx-home-circle',
            'is_active' => 1,
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);

        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Manage User',
            'url' => 'admin/manage-user',
            'icon' => 'bx bx-user',
            'is_active' => 1,
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);

        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Manage Menu',
            'url' => 'admin/manage-menu',
            'icon' => 'bx bx-menu',
            'is_active' => 1,
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);

        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Manage Submenu',
            'url' => 'admin/manage-submenu',
            'icon' => 'bx bx-menu-alt-right',
            'is_active' => 1,
            'created_by' => 'System', 
            'updated_by' => 'System',
        ]);
    }
}
