<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $data = array('name'=>'admin'
            ,'email'=>'admin@admin.com'
            ,'email_verified_at'=>now()
            ,'password'=>Hash::make('password'));

        Admin::create($data);

        // $user = new User();
        // $user->name = "client";
        // $user->email = "client@gmail.com";
        // $user->password = Hash::make('password');
        // $user->email_verified_at =now();
        // $user->save();
    }
}
