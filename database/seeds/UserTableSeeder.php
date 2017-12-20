<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('users')->truncate();
        User::create(
            [
                'name'     => 'admin',
                'email'    => 'ductranminhitqb@gmail.com',
                'password' => bcrypt('password'),
                'admin'    => true,
                'card_brand' => 'Visa',
                'card_last_four' => '4242 4242 4242 4242',
                'trial_ends_at' => '2020-07-19 10:00:00'
            ]
        );
        User::create(
            [
                'name'     => 'test',
                'email'    => 'duc@gmail.com',
                'password' => bcrypt('password'),
                'card_brand' => 'Visa',
                'card_last_four' => '4242 4242 4242 4242',
                'trial_ends_at' => '2020-07-19 10:00:00'
            ]
        );
    }
}
