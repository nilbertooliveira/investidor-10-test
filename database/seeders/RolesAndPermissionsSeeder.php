<?php

namespace Database\Seeders;

use App\Infrastructure\Database\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::firstOrCreate(
            [
                "email" => "administrator@test.com.br",
            ],
            [
                "name" => 'Administrator',
                "email" => "administrator@test.com.br",
                "password" => Hash::make('123456')
            ]);

        $user2 = User::firstOrCreate(
            [
                "email" => "reader@test.com.br",
            ],
            [
                "name" => 'Reader',
                "email" => "reader@test.com.br",
                "password" => Hash::make('123456')
            ]);

        $user3 = User::firstOrCreate(
            [
                "email" => "writer@test.com.br",
            ],
            [
                "name" => 'Writer',
                "email" => "writer@test.com.br",
                "password" => Hash::make('123456')
            ]);

        $role1 = Role::firstOrCreate(
            ['name' => 'Administrator'],
            ['name' => 'Administrator']
        );
        $role2 = Role::firstOrCreate(
            ['name' => 'Reader'],
            ['name' => 'Reader']);
        $role3 = Role::firstOrCreate(
            ['name' => 'Writer'],
            ['name' => 'Writer']);

        $permission1 = Permission::firstOrCreate(
            ['name' => 'store'],
            ['name' => 'store']);
        $permission2 = Permission::firstOrCreate(
            ['name' => 'update'],
            ['name' => 'update']);
        $permission3 = Permission::firstOrCreate(
            ['name' => 'destroy'],
            ['name' => 'destroy']);
        $permission4 = Permission::firstOrCreate(
            ['name' => 'show'],
            ['name' => 'show']);


        $role1->revokePermissionTo(
            [
                $permission1,
                $permission2,
                $permission3,
                $permission4
            ]
        );

        $role2->revokePermissionTo(
            [
                $permission4
            ]
        );

        $role3->revokePermissionTo(
            [
                $permission1,
                $permission2,
                $permission4
            ]
        );

        $user1->roles()->detach(
            [
                $role1->id,
            ]
        );
        $user2->roles()->detach(
            [
                $role2->id,
            ]
        );

        $user3->roles()->detach(
            [
                $role3->id,
            ]
        );

        $role1->givePermissionTo($permission1, $permission2, $permission3, $permission4);
        $role2->givePermissionTo($permission4);
        $role3->givePermissionTo($permission1, $permission2, $permission4);

        $user1->assignRole($role1);
        $user2->assignRole($role2);
        $user3->assignRole($role3);
    }
}
