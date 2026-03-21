<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('coaches', 'email')) {
            return;
        }

        Schema::table('coaches', function (Blueprint $table) {
            $table->dropUnique('coaches_email_unique');
        });

        Schema::table('coaches', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }

    public function down(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            if (!Schema::hasColumn('coaches', 'email')) {
                // Rollback-safe: do not enforce unique here because legacy data may contain duplicates.
                $table->string('email')->nullable()->after('last_name');
            }
        });
    }
};
