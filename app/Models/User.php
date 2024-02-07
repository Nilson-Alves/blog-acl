<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Hamcrest\Type\IsBoolean;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use function PHPUnit\Framework\isNull;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles():BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function password(): CastsAttributes
    {
        return new CastsAttributes(function($value){
           if(!empty($value) && !is_null($value)){
                return bcrypt($value);
           }
        });

    }

    public function hasRole(string $role):bool
    {
        return $this->roles()->whereName($role)->exists();
    }

    public function hasRoles(array $nomes):bool
    {
        return $this->roles()->whereIn('name', $nomes)->exists();
    }

    public function hasPermission(string $permission):bool
    {
        return $this->roles->filter(fn($role)=>$role->permissions()->whereName($permission)->exists())
        ->count() >0;
    }






}
