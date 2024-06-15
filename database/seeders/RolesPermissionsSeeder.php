<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('permissions')->truncate();

        $admin_role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $user_role = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        $permissions = [
            ['name' => 'create user', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'edit user', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'delete user', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'view users', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'create role', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'edit role', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'delete role', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'view roles', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'create permission', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'edit permission', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'delete permission', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'view permissions', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
            ['name' => 'view dashboard', 'guard_name' => 'web', 'updated_at' =>now(), 'created_at' =>now()],
           
        ];

        $chunks = array_chunk($permissions, 250);
        foreach ($chunks as $chunk) {
            Permission::insert($chunk);
        }

        $admin_role->givePermissionTo(
            [
                'create user',
                'edit user',
                'delete user',
                'view users',
                'create role',
                'edit role',
                'delete role',
                'view roles',
                'create permission',
                'edit permission',
                'delete permission',
                'view permissions',
                'view dashboard'
            ]
        );

        $user_role->givePermissionTo(
            [
                'view dashboard',
                'view roles',
                'view permissions',
            ]
        );
    }
}
