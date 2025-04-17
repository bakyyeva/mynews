<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = array(
            "admin",
            'editor'
        );

        $roles = [];

        for ($i = 0; $i < count($names); $i++) {
            array_push($roles, [
                'name' => $names[$i]
            ]);
        }

        foreach ($roles as $role) {
            Role::create($role);
        }

    }
}
