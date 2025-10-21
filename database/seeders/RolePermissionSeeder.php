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
        
        // 🔥 ADMIN → Full Control (ALL 24 permissions)
        $admin->permissions()->sync(Permission::all()->pluck('id'));

        // 👔 MANAGER → Business Operations (15 permissions - no user management, no critical deletes)
        $managerPermissions = Permission::whereIn('name', [
            // Products: create, update, view (NO delete)
            'create_product', 'update_product', 'view_product',
            // Orders: create, update, delete, view (full control)
            'create_order', 'update_order', 'delete_order', 'view_order',
            // Categories: create, update, view (NO delete)
            'create_categories', 'update_categories', 'view_categories',
            // Subcategories: create, update, view (NO delete)
            'create_subcategories', 'update_subcategories', 'view_subcategories',
            // Order Items: create, update, delete, view (full control)
            'create_order_items', 'update_order_items', 'delete_order_items', 'view_order_items'
        ])->pluck('id');
        $manager->permissions()->sync($managerPermissions);

        // 🛒 CUSTOMER → Limited Access (9 permissions - browse & own orders only)
        $customerPermissions = Permission::whereIn('name', [
            // Products: view only
            'view_product',
            // Categories: view only
            'view_categories',
            // Subcategories: view only
            'view_subcategories',
            // Orders: create, view, update (own orders only)
            'create_order', 'view_order', 'update_order',
            // Order Items: create, view, update (own items only)
            'create_order_items', 'view_order_items', 'update_order_items'
        ])->pluck('id');
        $customer->permissions()->sync($customerPermissions);

        // ✅ Assign roles to users by email instead of ID
        User::where('email', 'admin@example.com')->update(['role_id' => $admin->id]);
        User::where('email', 'manager@example.com')->update(['role_id' => $manager->id]);
        User::where('email', 'customer@example.com')->update(['role_id' => $customer->id]);
    }
}