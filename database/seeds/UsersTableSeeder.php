<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'name' => 'きわっち１',
                'email' => 'ymnkknt301@yahoo.co.jp',
                'password' => bcrypt('orange1212'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'きわっち２',
                'email' => 'ymnkknt3@gmail.com',
                'password' => bcrypt('orange1212'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]

        ]);
    }
}
