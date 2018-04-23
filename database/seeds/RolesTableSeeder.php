<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=Role::create(['name' => 'admin']);
        $role->givePermissionTo(['manager-list','manager-create','manager-edit','manager-delete','receptionist-list','receptionist-create','receptionist-edit','receptionist-delete','client-list','client-create','client-edit','client-delete','floor-list','floor-create','floor-edit','floor-delete','room-list','room-create','room-edit','room-delete']);

        $role=Role::create(['name' => 'manager']);
        $role->givePermissionTo(['receptionist-list','receptionist-create','receptionist-edit','receptionist-delete','client-list','client-create','client-edit','client-delete','floor-list','floor-create','floor-edit','floor-delete','room-list','room-create','room-edit','room-delete']);

        $role=Role::create(['name' => 'receptionist']);
        $role->givePermissionTo(['client-list']);

    }
}
