<?php

namespace domain\Facades\PermissionFacade;

use domain\Services\PermissionService\PermissionService;
use Illuminate\Support\Facades\Facade;

class PermissionFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return PermissionService::class;
    }

}