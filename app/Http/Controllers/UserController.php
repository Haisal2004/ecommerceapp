<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        return UserResource::collection(User::all());
    }

    // Create user
   public function store(StoreUserRequest $request)
{
    // Get default role (customer) if no role_id provided
    $defaultRoleId = $request->role_id ?? \App\Models\Role::where('name', 'customer')->first()->id;
    
    $user = User::create([
        'name'     => $request->name,
        'phone'    => $request->phone,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role_id'  => $defaultRoleId,  // ← This line was added
    ]);

    $user->load('userRole');  // ← This line was added
    return new UserResource($user);
}
    // Show one user
    public function show(User $user)
    {
        return new UserResource($user);
    }

    // Update user
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        $user->load('userRole');

        return new UserResource($user);
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
