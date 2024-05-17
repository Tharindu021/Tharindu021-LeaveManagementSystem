<?php

namespace domain\Services\LeaveDataService;
use App\Models\LeaveData;

class LeaveDataService
{
    protected $leave_data;

    public function __construct()
    {
        $this->leave_data = new LeaveData();
    }

    public function store($data)
    {
        return $this->leave_data->create($data);
    }

    public function delete($id)
    {
        $leave_data = $this->leave_data->find($id);
        return $leave_data->delete();
    }

}