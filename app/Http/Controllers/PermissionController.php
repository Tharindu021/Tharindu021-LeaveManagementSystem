<?php

namespace App\Http\Controllers;

use domain\Facades\PermissionFacade\PermissionFacade;
use domain\Facades\UserFacade\UserFacade;
use Illuminate\Http\Request;

class PermissionController extends ParentController
{
    public function allGroup()
    {
        return PermissionFacade::allGroup();
    }

    public function all()
    {
        return PermissionFacade::all();
    }

    public function updatePermission(Request $request, $id)
    {
        $data = $request;
        $user = UserFacade::get($id);
        return PermissionFacade::assignPermission($data,$user);
    }

    public function userPermission($id)
    {
        $user = UserFacade::get($id);
        return PermissionFacade::getUserPermission($user);
    }
}
