<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email');
            $table->string('avatar')->nullable()->after('role');
            $table->string('phone')->nullable()->after('avatar');
            $table->string('country')->nullable()->after('phone');
            $table->timestamp('last_login_at')->nullable()->after('country');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'avatar', 'phone', 'country', 'last_login_at']);
        });
    }
};