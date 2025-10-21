<?php

namespace App\Models;
use App\Models\Permission;


use Illuminate\Database\Eloquent\Relations\Pivot;

class RolePermission extends Pivot
{
    protected $table = 'role_permissions';
    protected $fillable = ['role_id', 'permission_id'];
}
