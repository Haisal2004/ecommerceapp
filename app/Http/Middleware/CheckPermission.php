<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = auth()->user();
        $userRole = $user->userRole;

        // If user has no role
        if (!$userRole) {
            return response()->json([
                'error' => "Cannot perform action because no role assigned"
            ], 403);
        }

        // Admin bypass: allow admins to perform actions even if target user has no role
        $permissions = $userRole->permissions->pluck('name')->toArray();

        if (!in_array($permission, $permissions)) {
            return response()->json([
                'error' => "Cannot perform this action: You do not have permission '$permission'"
            ], 403);
        }

        return $next($request);
    }
}
