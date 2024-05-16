<?php

namespace App\Http\Controllers;

use App\Filters\FuzzyFilter;
use domain\Facades\UserFacade\UserFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\DataResource;
use App\Models\User;

class UserController extends Controller
{

    public function index(){
        return Inertia::render('Users/index');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return UserFacade::store($data);
    }

    public function all()
    {
        $query = User::orderBy('id');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name', 'email','username','telephone')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }
}
