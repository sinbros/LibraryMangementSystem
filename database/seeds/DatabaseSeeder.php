<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $user = User::create();
        DB::table('users')->insert([
                'name' => 'sumit',
                'email' => 'sumit114433@gmail.com',
                'password' => bcrypt('sumit123'),
            ]);
    }
}
