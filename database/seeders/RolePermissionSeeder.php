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
        $admin->givePermissionTo(['view_data' , 'read_data' , 'delete_data' ]);
        
        $user = User::where('email','admin@gmail.com')->first();
        $user->assignRole('admin');
    }
}
