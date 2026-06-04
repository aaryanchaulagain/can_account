<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE contact_submissions MODIFY status ENUM('new', 'read', 'replied', 'archived', 'approved') NOT NULL DEFAULT 'new'");
        }

        Schema::table('contact_submissions', function (Blueprint $table) {
            if (! Schema::hasColumn('contact_submissions', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('read_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->dropColumn('approved_at');
        });

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE contact_submissions MODIFY status ENUM('new', 'read', 'replied', 'archived') NOT NULL DEFAULT 'new'");
        }
    }
};
