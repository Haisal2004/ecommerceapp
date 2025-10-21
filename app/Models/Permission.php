<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['name'];

    // Roles that have this permission
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
    }

    // Optional: Users assigned this permission directly
    public function users()
    {
        return $this->belongsToMany(User::class, 'model_permissions', 'permission_id', 'model_id');
    }
}
