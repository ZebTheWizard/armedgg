<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'see site overview']);
        Permission::create(['name' => 'manage site settings']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit faq']);
        Permission::create(['name' => 'edit news']);
        Permission::create(['name' => 'edit players']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'edit sponsors']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
