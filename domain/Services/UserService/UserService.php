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
        $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function get($id)
    {
        $user = $this->user->find($id);
        return $user;
    }

    public function update($data, $id)
    {
        $user = $this->user->find($id);
        return $user ->update($this->edit($user, $data));
    }

    protected function edit($user, $data)
    {
        return array_merge($user->toArray(), $data);
    }

    public function delete($id)
    {
        $user = $this->user->find($id);
        return $user->delete();
    }

}