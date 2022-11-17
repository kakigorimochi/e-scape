<?php

use App\Model\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_type' => 0,
            'fname'     => 'John',
            'lname'     => 'Smith',
            'birthdate' => date('Y-m-d', strtotime('1999-03-01')),
            'email'     => 'johnsmith@email.com',
            'phone'     => '09123456789',
            'username'  => 'johnsmith',
            'password'  => bcrypt('password')
        ]);
        User::create([
            'user_type' => 1,
            'fname'     => 'Jane',
            'lname'     => 'Smith',
            'birthdate' => date('Y-m-d', strtotime('1999-07-05')),
            'email'     => 'janesmith@email.com',
            'phone'     => '09876543210',
            'username'  => 'janesmith',
            'password'  => bcrypt('password')
        ]);
    }
}
