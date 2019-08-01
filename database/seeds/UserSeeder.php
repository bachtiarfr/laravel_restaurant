<?php

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
        $user = new \App\User;
        $user->name = "Rohim";
        $user->email = "rohim@gmail.com";
        $user->password = Hash::make("12345678");
        $user->status = "kasir";
        $user->remember_token = str_random(100);
        $user->save();
    }
}
