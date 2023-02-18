<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $data = array('name'=>'admin',
             'user_name' => 'admin',
             'position' => 'admin',
             'mobile_number' => "+971 58 580 2467",
            'email'=>'admin@admin.com'
            ,'email_verified_at'=>now()
            ,'password'=>Hash::make('password'),
            'temporary_password'=> Crypt::encrypt('password'));

       $admin =  Admin::create($data);
       $admin->assignRole('admin');
       $permissions = Permission::pluck('id');
       $admin->syncPermissions($permissions);
        // $user = new User();
        // $user->name = "client";
        // $user->email = "client@gmail.com";
        // $user->password = Hash::make('password');
        // $user->email_verified_at =now();
        // $user->company_name = 'qqqqqq';
        // $user->contact_name = 'qqqqqq';
        // $user->mobile_number = 'qqqqqq';
        // $user->whatsapp_number = 'qqqqqq';
        // $user->address = 'qqqqqq';
        // $user->license_number = 'qqqqqq';
        // $user->save();
    }
}
