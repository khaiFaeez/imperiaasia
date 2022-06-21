<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Portfolio extends Model
{
    use HasFactory;
    use HasRoles;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'portfolio_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        // here assign this team to a global user with global default role
        self::created(function ($model) {
            // get session team_id for restore it later
            $session_team_id = getPermissionsTeamId();
            // set actual new team_id to package instance
            setPermissionsTeamId($model);
            // get the admin user and assign roles/permissions on new team model
            $user =  User::find(1);
            $user->assignRole('superadmin');
            // restore session team_id to package instance
            setPermissionsTeamId($user->current_portfolio_id);
        });
    }
}
