<?php

namespace App\Admin;

use App\User;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected  $table = "roles";

    protected $fillable = ['name', 'display_name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function hasAccess(array $permissions)
    {
        foreach($permissions as $permission){
            if($this->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }
    // public function hasPermission(string $permission)
    // {
    //     $permissions = json_decode(  $this->permission, true);
    //     return $permissions[$permission]? $permissions[$permission]: false;
    // }
}
