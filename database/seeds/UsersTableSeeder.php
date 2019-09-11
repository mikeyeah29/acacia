<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        User::create([
            'name' => 'Scott',
            'email' => 'scott@acacia.com',
            'password' => Hash::make('acacia2019')
        ]);
    }
}
