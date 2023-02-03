<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Role extends \Spatie\Permission\Models\Role
{
    //------------------ Constantes ---------------------------------
    const SUPER_ADMIN = "super_administrator";
    const ADMIN = "administrator";
    const MANAGER = "manager";
    const HAIRDRESSER = "hairdresser";
    const CLIENT = "client";

    protected $fillable = [
        'name',
        'guard_name',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDefault', function (Builder $builder) {
            $builder
                ->orderBy("name", "DESC");
        });

    }

    //------------------ Méthodes ---------------------------------

    /**
     * @return Collection
     */
    public static function static_getRolesDescription(): Collection
    {
        return new Collection([
            self::SUPER_ADMIN => "Super Administrateur",
            self::ADMIN => "Administrateur",
            self::MANAGER => "Manager",
            self::HAIRDRESSER => "coiffeur.se",
            self::CLIENT => "Client/Utilisateur"
        ]);
    }

    public static function static_getRoles(): Collection
    {
        return new Collection([
            self::SUPER_ADMIN => "super_administrator",
            self::ADMIN => "administrator",
            self::MANAGER => "manager",
            self::HAIRDRESSER => "hairdresser",
            self::CLIENT => "client"
        ]);
    }

    /**
     * @param string $name
     * @return string
     */
    public static function getDescriptionByName(string $name): string
    {
        return self::static_getRoles()->get($name);
    }

    /**
     * @return Collection
     */
    public static function static_getRoleManagers(): Collection
    {
        return new Collection([
            self::SUPER_ADMIN,
            self::ADMIN,
            self::MANAGER,
            self::HAIRDRESSER,
            self::CLIENT
        ]);
    }
}
