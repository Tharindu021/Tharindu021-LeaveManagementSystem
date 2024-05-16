<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    protected $permission;

    public function __construct()
    {
        $this->permission = new Permission();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions =
        [
            //Admin
            [
                'name' => 'create_data',
                'group_name' => 'Admin Privileges',
            ],
            [
                'name' => 'read_data',
                'group_name' => 'Admin Privileges',
            ],
            [
                'name' => 'delete_data',
                'group_name' => 'Admin Privileges',
            ],
            [
                'name' => 'update_data',
                'group_name' => 'Admin Privileges',
            ],

            //USer
            [
                'name' => 'read_data',
                'group_name' => 'User Privileges',
            ],
            [
                'name' => 'read_data',
                'group_name' => 'User Privileges',
            ],
            [
                'name' => 'delete_data',
                'group_name' => 'User Privileges',
            ],
        ];

        foreach($permissions as $permission){
            $old_permission = $this->permission->where('name',$permission['name'])->first();
            if(!$old_permission){
                $this->permission->create($permission);
            }
        }
    }
}
