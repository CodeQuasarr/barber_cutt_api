<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Permission extends \Spatie\Permission\Models\Permission
{
    //------------------ Constantes -----------------------------


    /**
     * Constantes : Permission
     */

    const P_USERS_READ = "users_read";
    const P_USERS_CREATE = "users_create";
    const P_USERS_UPDATE = "users_update";
    const P_USERS_UPDATE_ADMIN = "users_update_admin";


    /**
     * @return Collection
     */
    public static function static_getPermissions(): Collection
    {
        return new Collection([
            self::P_USERS_READ         => "Voir les utilisateurs",
            self::P_USERS_CREATE       => "Créer les utilisateurs",
            self::P_USERS_UPDATE       => "Modifier les utilisateurs",
            self::P_USERS_UPDATE_ADMIN => "Administrer les utilisateurs, attribuer des roles.",
        ]);
    }

    /**
     * @param string $roleName
     * @return array|\Illuminate\Database\Eloquent\Collection|null
     */
    public static function static_getPermissionsByRoleName(string $roleName): null|array|\Illuminate\Database\Eloquent\Collection
    {
        return match ($roleName) {
            Role::SUPER_ADMIN => self::all(),
            Role::MANAGER => self::static_getPermissions_manager(),
            Role::CLIENT => self::static_getPermissions_client(),
            Role::ADMIN => self::static_getPermissions_administrator(),
            Role::HAIRDRESSER => self::static_getPermissions_hairdresser(),
            default => null,
        };
    }

    /**
     * @return string[]
     */
    private static function static_getPermissions_administrator(): array
    {
        return [
            self::P_USERS_READ,
            self::P_USERS_CREATE,
            self::P_USERS_UPDATE,
            self::P_USERS_UPDATE_ADMIN,
        ];
    }

    /**
     * @return string[]
     */
    private static function static_getPermissions_client(): array
    {
        return [
            self::P_USERS_READ,
            self::P_USERS_CREATE,
            self::P_USERS_UPDATE,
            self::P_USERS_UPDATE_ADMIN,
        ];
    }

    /**
     * @return string[]
     */
    private static function static_getPermissions_manager(): array
    {
        return [
            self::P_USERS_READ,
            self::P_USERS_CREATE,
            self::P_USERS_UPDATE,
            self::P_USERS_UPDATE_ADMIN,
        ];
    }

    /**
     * @return string[]
     */
    private static function static_getPermissions_hairdresser(): array
    {
        return [
            self::P_USERS_READ,
            self::P_USERS_CREATE,
            self::P_USERS_UPDATE,
            self::P_USERS_UPDATE_ADMIN,
        ];
    }

}
