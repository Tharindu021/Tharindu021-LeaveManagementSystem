<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialUsers = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '12345678',
            ]
            ];

            foreach($initialUsers as $user){
                $old_user = $this->user->getByEmail($user['email']);
                if(!$old_user){
                    $this->user->create(
                        [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'password' => Hash::make($user['password']),
                        ]
                    );
                }
            }
    }
}
