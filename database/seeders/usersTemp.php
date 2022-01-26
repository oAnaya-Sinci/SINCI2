<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usersTemp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Admin Sinci',
            'email'=>'admin@sinci.com',
            'password'=>Hash::make('Server2106')
        ]);

        DB::table('users')->insert([
            'name'=>'Carlos Omar Anaya Barajas',
            'email'=>'oanaya@sinci.com',
            'password'=>Hash::make('Om@r1989')
        ]);
    }
}
