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
            //User
            [
                'name' => 'create_user',
                'group_name' => 'User Privileges',
            ],
            [
                'name' => 'view_user',
                'group_name' => 'User Privileges',
            ],
            [
                'name' => 'delete_user',
                'group_name' => 'User Privileges',
            ],
            [
                'name' => 'update_user',
                'group_name' => 'User Privileges',
            ],
            [
                'name' => 'update_password',
                'group_name' => 'User Privileges',
            ],
            [
                'name' => 'update_permission',
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
