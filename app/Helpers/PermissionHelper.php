<?php
namespace App\Helpers;

use App\Models\Permission;

class PermissionHelper
{
    public static function hasPermission($user, $permission)
    {   
        if (!$user->role) return false;   //---added new
        // Assuming $user->role_id exists and role_permissions table links role_id -> permission_id
        $rolePermissions = $user->role->permissions->pluck('name')->toArray();
        return in_array($permission, $rolePermissions);
    }
}
