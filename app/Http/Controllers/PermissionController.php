<?php

namespace App\Http\Controllers;

use domain\Facades\PermissionFacade\PermissionFacade;
use domain\Facades\UserFacade\UserFacade;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $user = UserFacade::get($id);
        $user->syncPermissions($request->permissions);
    }
}
