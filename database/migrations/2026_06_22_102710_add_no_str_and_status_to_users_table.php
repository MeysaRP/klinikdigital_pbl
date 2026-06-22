<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'no_str')) {
                $table->string('no_str')->nullable()->after('no_identitas');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->nullable()->default('Aktif')->after('no_str');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('users', 'no_str')) {
                $table->dropColumn('no_str');
            }
        });
    }
};