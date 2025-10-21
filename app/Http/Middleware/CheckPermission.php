<?php

namespace App\Http\Middleware;
use App\Models\Permission;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\PermissionHelper;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::user();

        if (!PermissionHelper::hasPermission($user, $permission)) {
            return response()->json(['error' => 'You do not have permission'], 403);
        }

        return $next($request);
    }
}

