<?php

namespace domain\Facades\RoleFacade;

use domain\Services\RoleService\RoleService;
use Illuminate\Support\Facades\Facade;

class RoleFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return RoleService::class;
    }

}