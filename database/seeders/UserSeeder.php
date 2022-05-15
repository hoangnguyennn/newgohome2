<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->fullname = 'Admin';
        $user->email = 'admin@gohome.com';
        $user->password = Hash::make('password');
        $user->role = 'admin';
        $user->save();

        $user = new User;
        $user->fullname = 'User';
        $user->email = 'user@gohome.com';
        $user->password = Hash::make('password');
        $user->role = 'user';
        $user->save();
    }
}
