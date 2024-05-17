<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveData extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS = [
        'PENDING' => 0,
        'ACCEPTED' => 1,
        'REJECTED' => 2,
    ];

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'reason',
        'status',
    ];

    protected $appends = [
        'name',
    ];

    public function user_name()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getNameAttribute()
    {
        return $this->user_name?$this->user_name->name:'N/A';
    }
}
