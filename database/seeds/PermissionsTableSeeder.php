<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'manager-list',
            'manager-create',
            'manager-edit',
            'manager-delete',
            'receptionist-list',
            'receptionist-create',
            'receptionist-edit',
            'receptionist-delete',
            'client-list',
            'client-create',
            'client-edit',
            'client-delete',
            'floor-list',
            'floor-create',
            'floor-edit',
            'floor-delete',
            'room-list',
            'room-create',
            'room-edit',
            'room-delete',
         ];
 
 
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
