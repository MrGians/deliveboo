<?php

use App\User;
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
        $new_user = new User();
        $new_user->name = 'admin';
        $new_user->email = 'admin@gmail.com';
        $new_user->password = bcrypt('password');
        $new_user->save();
        
    }
}
