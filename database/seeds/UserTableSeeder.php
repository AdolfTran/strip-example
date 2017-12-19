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
                'name'               => 'admin',
                'email'        => 'ductranminhitqb@gmail.com',
                'password' => bcrypt('password'),
            ]
        );
    }
}
