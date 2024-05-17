<?php

namespace domain\Services\RoleService;
use Spatie\Permission\Models\Role;

class RoleService
{
    protected $role;

    public function __construct()
    {
        $this->role = new Role();
    }
    
    public function all()
    {
        return $this->role->all();
    }
}