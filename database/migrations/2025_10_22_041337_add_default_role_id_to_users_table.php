<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get the customer role ID
        $customerRole = Role::where('name', 'customer')->first();
        
        if ($customerRole) {
            Schema::table('users', function (Blueprint $table) use ($customerRole) {
                $table->unsignedBigInteger('role_id')->default($customerRole->id)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default(null)->change();
        });
    }
};