<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@pokerface.com',
            'password' => bcrypt('password'),
            'user_level' => 10,
            'created_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@pokerface.com',
            'password' => bcrypt('password'),
            'user_level' => 1,
            'created_at' => Carbon::now()
        ]);
    }
}
