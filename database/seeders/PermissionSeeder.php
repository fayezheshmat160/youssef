<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Dashboard\Admin\Admin;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //if (Permission::count() == 0) {

        /*
        |
        | Make Role "owner" In System
        |
        */
        $owner =  Role::create(['name' => 'owner', 'guard_name' => adminGuardName()]);
        // Create Default Owner
        $userOwner = Admin::create([
            'f_name'   => "Alsite",
            'l_name'   => "Tech",
            'full_name'  => "Alsite Tech",
            'email'    => 'admin@gmail.com',
            'password'   => Hash::make('123'),
            ]);
        $userOwner->assignRole($owner);
        //}
    }


    public function setRoleAndPermisson($roleKey)
    {
        $role = Role::create(['name' => $roleKey, 'guard_name' => adminGuardName()]); // Create Rol
        $permissions = getPermissions($roleKey);
        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm, 'guard_name' => adminGuardName()]); // Create Permissions
            $role->givePermissionTo($perm); // Set This Permisson For The Role
        }

        return $role;
    }
}
