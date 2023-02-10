<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
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
            ,'password'=>Hash::make('12345678'));

        Admin::create($data);
    }
}
