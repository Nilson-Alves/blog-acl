<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{

    /**
    * @return BelongsToMany
    */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()->whereName($role)->exists();
    }

    /**
    * @param array $nomes
    * @return bool
    */
    public function hasRoles(array $roles): bool
    {
        return  $this->roles()->whereIn('name', $roles)->exists();
    }


    /**
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return  $this->roles->filter(fn ($role) => $role->permissions()->whereName($permission)->exists())
            ->count() > 0;
    }
}
