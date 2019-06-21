<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        $permission_1= Permission::create(['name' => 'Perform All CRUD operations']);
        $permission_2=  Permission::create(['name' => 'Manager All Users ']);
        $permission_3=   Permission::create(['name' => 'Perform CRUD oon users']);
        $permission_4=  Permission::create(['name' => 'Add Records']);

        // create roles and assign created permissions  0-admin 1-manager 2-user
        $role=   Role::create([ 'name' => 'Admin']);
        $role->givePermissionTo([$permission_1,$permission_2]);

        $role1= Role::create(['name' => 'Manager']);
        $role1->givePermissionTo($permission_3);

        $role2= Role::create(['name' => 'RegularUser']);
        $role2->givePermissionTo($permission_4);



    }
}
