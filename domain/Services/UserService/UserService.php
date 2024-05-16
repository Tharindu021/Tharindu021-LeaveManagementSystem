<?php

namespace domain\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function store($data)
    {
        return $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}