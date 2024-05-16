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
use Illuminate\Support\Facades\Log;

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

    public function get($id)
    {
        $response['user'] = UserFacade::get($id);
        Log::info('Response:', $response);
        return Inertia::render('Users/edit', $response);
    }

    public function getFormData($id)
    {
        $data = UserFacade::get($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        return UserFacade::update($request->all(),$id);
    }

    public function delete($id)
    {
        return UserFacade::delete($id);
    }
}
