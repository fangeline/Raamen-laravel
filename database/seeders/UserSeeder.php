<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            ['username'=>'fei',
             'email'=>'fei@gmail.com',
             'password'=>bcrypt('1111'),
             'gender'=>'female',
             'role'=>0],
            ['username'=>'lana',
             'email'=>'lanadelray@gmail.com',
             'password'=>bcrypt('1111'),
             'gender'=>'female',
             'role'=>1],
            ['username'=>'taylor',
             'email'=>'tay1989@gmail.com',
             'password'=>bcrypt('1111'),
             'gender'=>'female',
             'role'=>2]
        ];
        foreach($users as $user)
        {
            User::create($user);
        }
    }
}
