<?php

use App\User;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 5000)->create();

        // $users = [];
        // for($i= 0; $i< 5000; $i++){
        //     $users[] = [
        //         'name' => "users anme $i",
        //         'email' => "useremail_$i@test.com",
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('123456'), // password
        //         'remember_token' => Str::random(10),
        //     ];
        // }
        // User::insert($users);
    }
}
