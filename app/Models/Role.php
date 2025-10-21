<?php

namespace App\Models;
use App\Models\Permission;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';           // Table name
    protected $fillable = ['name'];       // Fillable fields

    // Define many-to-many relationship with Permission
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    // Users assigned to this role
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
    
}
