<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('users')->insert([
            'login' => 'admin_qr',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('860723a'),
            'admin' => 1,
        ]);
    }
}
