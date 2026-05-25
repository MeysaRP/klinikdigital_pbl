<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('id');
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'tgl_lahir')) {
                $table->date('tgl_lahir')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('tgl_lahir');
            }
            if (!Schema::hasColumn('users', 'kategori')) {
                $table->string('kategori')->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('users', 'no_identitas')) {
                $table->string('no_identitas')->nullable()->after('kategori');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'no_identitas')) {
                $table->dropColumn('no_identitas');
            }
            if (Schema::hasColumn('users', 'kategori')) {
                $table->dropColumn('kategori');
            }
            if (Schema::hasColumn('users', 'no_hp')) {
                $table->dropColumn('no_hp');
            }
            if (Schema::hasColumn('users', 'tgl_lahir')) {
                $table->dropColumn('tgl_lahir');
            }
            if (Schema::hasColumn('users', 'alamat')) {
                $table->dropColumn('alamat');
            }
            if (Schema::hasColumn('users', 'username')) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            }
        });
    }
};
