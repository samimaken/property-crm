<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = ['properties', 'units', 'clients', 'contracts', 'quote-requests', 'booking-calendar', 'tickets', 'users', 'user-activities'];
        $types = ['read', 'write', 'delete'];

        foreach($modules as $module){
            foreach($types as $type) {
                $permission_name = $type.'-'.$module;
                Permission::create(['name' => $permission_name, 'guard_name' => 'admin']);
            }
        }
    }
}
