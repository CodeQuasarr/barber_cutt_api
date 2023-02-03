<?php

namespace App\Console\Commands;

use App\Models\Users\Permission;
use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateRoleAndPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateRoleAndPermission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modifier les roles et permissions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        Schema::disableForeignKeyConstraints();
        Model::unguard();

        $this->truncate("model_has_permissions");
        $this->truncate("permissions");

        Model::reguard();
        Schema::enableForeignKeyConstraints();

        $this->info('Mise a jour des Roles');
//        $this->call('db:seed', [
//            '--class' => 'RolesTableSeeder',
//            '--force' => true,
//        ]);

        $this->updateRoles();

        $this->updatePermissions();

        $this->info('Mise à jour des Liens Roles/Permissions');

        $roles = Role::static_getRoles();
        $bar = $this->output->createProgressBar($roles->count());
        $bar->start();

        foreach ($roles as $roleName => $roleLibelle) {
            $this->syncRolesPermissions($roleName);
            $bar->advance();
        }
        $bar->finish();
        $this->info('');
        $this->info('');

        $this->info('Terminé');

        return Command::SUCCESS;
    }


    /**
     *  update roles table with new roles and delete old roles if exist in database table roles and not in static_getRoles() method in Role model class
     */
    private function updateRoles()
    {
        $this->info('Mise a jour des Roles');

        $roles = Role::static_getRoles();

        $bar = $this->output->createProgressBar($roles->count());
        $bar->start();
        foreach ($roles as $key => $const) {
            Role::query()->withoutGlobalScopes()->updateOrCreate(['name' => $key]);
            $bar->advance();
        }
        $bar->finish();
        $this->info('');
        $this->info('');

        /** on supprime les roles en trop en bdd */

        foreach (Role::all() as $item) {
            if ($roles->get($item->name) === null) {
                /** @var Role $roleToDelete */
                $roleToDelete = Role::query()->where("name", "=", $item->name)->first();

                if ($roleToDelete) {
                    foreach ($roleToDelete->users as $user) {
                        /** @var User $user */
                        $user->current_role_name = Role::CLIENT;
                        $user->save();
                        $user->removeRole($roleToDelete);
                        $user->save();
                    }

                    $roleToDelete->forceDelete();
                }

            }
        }

    }

    /**
     * @return void
     */
    public function updatePermissions(): void
    {
        $this->info('Mise a jour des Permissions');
        $permissions = Permission::static_getPermissions();
        $bar = $this->output->createProgressBar($permissions->count());
        $bar->start();

        foreach ($permissions as $key => $const) {
            //$this->info('Permission : ' . $const);
            Permission::query()->withoutGlobalScopes()->updateOrCreate(['name' => $key], ['name' => $key]);
            $bar->advance();
        }
        $bar->finish();
        $this->info('');
        $this->info('');
    }


    /**
     * @param string $roleName
     * @return void
     */
    public function syncRolesPermissions(string $roleName): void
    {
        /** @var Role $role */
        $role = Role::findByName($roleName);
        $role->revokePermissionTo(Permission::all());

        $permissions = Permission::static_getPermissionsByRoleName($roleName);

        if ($permissions) {
            $role->givePermissionTo($permissions);
        } else {
            $this->alert("Non configuré pour ce role : $roleName !!!");
        }
    }

    /**
     * Truncate a table with foreign key checks disabled and re-enabling them afterwards. This is useful for truncating tables
     * @param $table
     * @return bool
     */
    protected function truncate($table): bool
    {
        if (DB::getDefaultConnection() === 'mysql') {
            DB::table($table)->truncate();
            return true;
        } return false;
    }
}
