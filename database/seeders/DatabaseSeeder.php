<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        Artisan::call('key:generate');
        Artisan::call('storage:link');

        $this->call([
            RoleSeeder::class,
            PermissionsSeeder::class,
        ]);

        User::factory(3)->create();
        News::factory(12)->create();

        $users = User::query()
            ->whereNot('role', 'admin')
            ->get();

        $editorRole = Role::query()
            ->where('name', 'editor')
            ->firstOrFail();

        foreach ($users as $user) {
            $user->assignRole($editorRole);
        }


    }
}
