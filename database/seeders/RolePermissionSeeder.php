<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name','admin')->first();
        $admin->givePermissionTo(['create_user' , 'view_user' , 'delete_user', 'update_user', 'update_password', 'update_permission' ]);
        
        $user = User::where('email','admin@gmail.com')->first();
        $user->assignRole('admin');
    }
}
