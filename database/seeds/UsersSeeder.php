<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();

        DB::table('users')->delete();

        User::create(array(
            'first_name' => 'Admin',
            'last_name'  => 'User',
            'email'      => 'admin@katniss.com',
            'password'   => Hash::make('password'),
            'birthdate'  => '2016-10-01',
            'gender'     => 'm',
            'is_admin'   => 1
        ));

        User::create(array(
            'first_name' => 'Member',
            'last_name'  => 'User',
            'email'      => 'member@katniss.com',
            'password'   => Hash::make('password'),
            'birthdate'  => '2016-10-01',
            'gender'     => 'f',
        ));

    	Model::reguard();
    }
}
