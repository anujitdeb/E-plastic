<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Roles
        $roleGod = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        $premiumUser = Role::create(['name' => 'premiumUser', 'guard_name' => 'web']);


        //Permissions
        $permissions = [
            'dashboard.view',


            //permissions names for admins
            'admin.create',
            'admin.view',
            'admin.edit',
            'admin.delete',
            'admin.approve',

            //permission name for users
            'user.create',
            'user.view',
            'user.edit',
            'user.delete',
            'user.approve',

            //permissions names for role
            'role.create',
            'role.view',
            'role.edit',
            'role.delete',
            'role.approve',
            //permissions names for setting
            'setting.view',



        ];

        $permissions_users = [
            'offer.view',
            'transaction.view'
        ];

        //Create and Assign Premission for admin
        for ($i = 0; $i < count($permissions); $i++) {
            //Create Permission
            $permission = Permission::create(['name' => $permissions[$i], 'guard_name' => 'admin']);

            //Assign Permission to a Role
            $roleGod->givePermissionTo($permission);
        }

        //Create and Assign Premission for users
        for ($i = 0; $i < count($permissions_users); $i++) {
            //Create Permission
            $permission_users = Permission::create(['name' => $permissions_users[$i], 'guard_name' => 'web']);

            //Assign Permission to a Role
            $premiumUser->givePermissionTo($permission_users);
        }
    }
}
