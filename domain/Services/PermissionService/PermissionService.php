<?php

namespace domain\Services\PermissionService;

use Spatie\Permission\Models\Permission;

class PermissionService
{
    protected $permission;

    public function __construct()
    {
        $this->permission = new Permission();
    }
    
    public function allGroup()
    {
        return $this->permission->orderBy('group_name','asc')->select('group_name')->distinct()->get();
    }

    public function all()
    {
        return $this->permission->all();
    }

    public function assignPermission($data,$user)
    {
        $user->syncPermissions($data->permissions);
    }

    public function getUserPermission($user)
    {
        $permission = $user->getAllPermissions()->pluck('name');
        return $permission;
    }
}