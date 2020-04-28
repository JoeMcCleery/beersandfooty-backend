<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'email' => 'mccleery.joseph@gmail.com',
            'first_name' => 'Joseph',
            'last_name' => 'McCleery',
            'password' => 'change-this'
        ]);
    }

}
