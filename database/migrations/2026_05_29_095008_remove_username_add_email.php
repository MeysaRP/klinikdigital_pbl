<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            });
        }

        if (Schema::hasColumn('dokters', 'username')) {
            Schema::table('dokters', function (Blueprint $table) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            });
        }

       // DB::table('dokters')->whereNull('email')->orWhere('email', '')->update([
       //    'email' => DB::raw("CONCAT('temp-', id, '@meditech.local')")
       //]);

        //Schema::table('dokters', function (Blueprint $table) {
        //    $table->string('email')->nullable(false)->unique()->change();
        //});
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
        });

        Schema::table('dokters', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
        });

        if (Schema::hasColumn('dokters', 'email')) {
            Schema::table('dokters', function (Blueprint $table) {
                $table->dropUnique(['email']);
                $table->dropColumn('email');
            });
        }
    }
};