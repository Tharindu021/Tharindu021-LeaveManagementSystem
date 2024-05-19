<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\LeaveData;
use domain\Facades\LeaveDataFacade\LeaveDataFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LeaveDataController extends ParentController
{
    public function myleaveIndex()
    {
        return Inertia::render('MyLeaves/index');
    }

    public function myleaveData()
    {
        $user_id = Auth::user()->id;
        if($user_id == 1)
        {
            $query = LeaveData::orderBy('start_date', 'desc');
            if (request('search_start_date')) {
                $start_date = request('search_start_date');
                $query->where('start_date', 'like', "%{$start_date}%");
            }
            if (request('search_end_date')) {
                $end_date = request('search_end_date');
                $query->where('end_date', 'like', "%{$end_date}%");
            }
            $payload = QueryBuilder::for($query)
                ->allowedSorts(['start_date'])
                ->allowedFilters([
                    AllowedFilter::callback('search', function ($query, $value) {
                        $query->whereHas('start_date', 'like', "%{$value}%")
                            ->orWhere('end_date', 'like', "%{$value}%");
                        })
                    ])
                ->paginate(request('per_page', config('basic.pagination_per_page')));
            return DataResource::collection($payload);
        }else
        {
            $query = LeaveData::orderBy('start_date', 'desc')
            ->where('user_id', $user_id);
            if (request('search_start_date')) {
                $start_date = request('search_start_date');
                $query->where('start_date', 'like', "%{$start_date}%");
            }
            if (request('search_end_date')) {
                $end_date = request('search_end_date');
                $query->where('end_date', 'like', "%{$end_date}%");
            }
            $payload = QueryBuilder::for($query)
                ->allowedSorts(['start_date'])
                ->allowedFilters([
                    AllowedFilter::callback('search', function ($query, $value) {
                        $query->whereHas('start_date', 'like', "%{$value}%")
                            ->orWhere('end_date', 'like', "%{$value}%");
                        })
                    ])
                ->paginate(request('per_page', config('basic.pagination_per_page')));
            return DataResource::collection($payload);
        }
    }

    public function myleaveStore(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        return LeaveDataFacade::store($data);
    }

    public function myleaveDelete($id)
    {
        return LeaveDataFacade::delete($id);
    }
}
