<?php

namespace domain\Facades\LeaveDataFacade;

use domain\Services\LeaveDataService\LeaveDataService;
use Illuminate\Support\Facades\Facade;

class LeaveDataFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return LeaveDataService::class;
    }

}