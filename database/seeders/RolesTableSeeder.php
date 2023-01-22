<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::query()->whereKeyNot(1)->get();
//        $users->assignRole([Role::SUPER_ADMIN, Role::ADMIN, Role::HAIRDRESSER, Role::MANAGER, Role::CLIENT]);
        $users->each(function ($user) {
            $user->assignRole(Role::HAIRDRESSER);
        });
    }
}
