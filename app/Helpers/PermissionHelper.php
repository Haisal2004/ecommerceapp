<?php
namespace App\Helpers;

use App\Models\Permission;

class PermissionHelper
{
    public static function hasPermission($user, $permission)
    {   
        if (!$user->userRole) return false;   //---fixed relationship name
        // Assuming $user->role_id exists and role_permissions table links role_id -> permission_id
        $rolePermissions = $user->userRole->permissions->pluck('name')->toArray();
        return in_array($permission, $rolePermissions);
    }
}
