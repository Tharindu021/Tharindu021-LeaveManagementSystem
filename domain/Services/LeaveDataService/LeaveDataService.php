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

    public function acceptLeave($id)
    {
        $leave_data = $this->leave_data->find($id);
        $leave_data->status = 1;
        $leave_data->update();
    }

    public function rejectLeave($id)
    {
        $leave_data = $this->leave_data->find($id);
        $leave_data->status = 2;
        $leave_data->update();
    }

}