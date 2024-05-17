<?php

namespace App\Http\Controllers;

use domain\Facades\RoleFacade\RoleFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Contracts\Role;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\DataResource;


class RoleController extends Controller
{
    public function index()
    {
        return Inertia::render('PermissionManagement/SelectRole/index');
    }

    public function all()
    {   
        return RoleFacade::all();
    }
}
