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
            'name' => 'Joseph',
            'password' => 'change-this'
        ]);
    }

}
