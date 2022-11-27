<?php

use App\Model\User;
use App\Model\Wallet;
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
        $commuter = User::create([
            'user_type' => User::TYPE_COMMUTER,
            'fname'     => 'Juan',
            'lname'     => 'De La Cruz',
            'birthdate' => date('Y-m-d', strtotime('1999-03-01')),
            'email'     => 'commuter@email.com',
            'phone'     => '09123456789',
            'password'  => bcrypt('password')
        ]);
        $operator = User::create([
            'user_type' => User::TYPE_OPERATOR,
            'fname'     => 'Manong',
            'lname'     => 'Drayber',
            'birthdate' => date('Y-m-d', strtotime('1999-07-05')),
            'email'     => 'operator@email.com',
            'phone'     => '09876543210',
            'password'  => bcrypt('password')
        ]);
        Wallet::create(['user_id' => $commuter->id]);
        Wallet::create(['user_id' => $operator->id]);
    }
}
