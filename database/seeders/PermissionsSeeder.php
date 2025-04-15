<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'user_list']);
        Permission::create(['name' => 'user_add']);
        Permission::create(['name' => 'user_edit']);
        Permission::create(['name' => 'user_remove']);

        $newList = Permission::create(['name' => 'new_list']);
        $newAdd = Permission::create(['name' => 'new_add']);
        $newEdit = Permission::create(['name' => 'new_edit']);
        $newRemove = Permission::create(['name' => 'new_remove']);

        $roleAdmin = Role::query()
            ->where('name', 'admin')
            ->first();

        $roleAdmin->givePermissionTo(Permission::all());


        $roleEditor = Role::query()
            ->where('name', 'editor')
            ->first();

        $roleEditor->givePermissionTo([
            $newList, $newAdd, $newEdit
        ]);





    }
}
