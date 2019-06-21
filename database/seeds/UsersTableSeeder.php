<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [

            [

                'email'             => 'admin@admin.com',
                'name'=>'Admin',
                'user_type'=>0,
                'password'          => bcrypt('1234'),
                'is_active'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [

                'name'=>'Backend',
                'user_type'=>1,

                'email'             => 'manager@manager.com',
                'password'          => bcrypt('1234'),
                'is_active'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [

                'name'=>'User',
                'email'             => 'user@user.com',
                'password'          => bcrypt('1234'),
                'is_active'         => true,
                'user_type'         => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];


        \Illuminate\Support\Facades\DB::table('users')->insert($users);
    }
}
