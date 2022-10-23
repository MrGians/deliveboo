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

        foreach(config('data.users') as $user){
            $new_user = new User();
            $new_user->name = $user['name'];
            $new_user->email = $user['email'];
            $new_user->password = bcrypt('password');
            $new_user->save();
        }
        
    }
}
