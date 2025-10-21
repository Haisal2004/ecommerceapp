<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Roles
        $admin = Role::updateOrCreate(['name' => 'admin'], ['name' => 'admin']);
        $manager = Role::updateOrCreate(['name' => 'manager'], ['name' => 'manager']);
        $customer = Role::updateOrCreate(['name' => 'customer'], ['name' => 'customer']);

        // Permissions
        $permissions = [
            'create_product','update_product','delete_product','view_product',
    // Orders
    'create_order','update_order','delete_order','view_order',
    // Users
    'create_users','update_users','delete_users','view_users',
    // Categories
    'create_categories','update_categories','delete_categories','view_categories',
    // Subcategories
    'create_subcategories','update_subcategories','delete_subcategories','view_subcategories',
    // Order Items
    'create_order_items','update_order_items','delete_order_items','view_order_items',
        ];

        foreach ($permissions as $perm) {
            Permission::updateOrCreate(['name' => $perm], ['name' => $perm]);
        }

        // Assign permissions to roles
       // Admin → all permissions
$admin->permissions()->sync(Permission::all()->pluck('id'));

// Manager → all except delete permissions
// Manager → all except delete_*
$manager->permissions()->sync(
    Permission::whereNotLike('name', 'delete_%')
              ->whereNotLike('name', 'create_users') // if manager shouldn't create users
              ->pluck('id')
);


// Customer → view only + create_order
$customer->permissions()->sync(Permission::where(function($q){
    $q->where('name', 'create_order')->orWhere('name', 'like', 'view_%');
})->pluck('id'));


        // ✅ Assign roles to users by email instead of ID
        User::where('email', 'admin@example.com')->update(['role_id' => $admin->id]);
        User::where('email', 'manager@example.com')->update(['role_id' => $manager->id]);
        User::where('email', 'customer@example.com')->update(['role_id' => $customer->id]);
    }
}

