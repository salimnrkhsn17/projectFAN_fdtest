<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Jalankan hanya jika database PostgreSQL
        if (DB::getDriverName() !== 'pgsql') {
            // Skip migration jika bukan PostgreSQL (misal SQLite untuk test)
            return;
        }
        // Tambah 7 jam agar jadi WIB
        DB::statement("UPDATE users SET email_verified_at = email_verified_at + INTERVAL '7 hour' WHERE email_verified_at IS NOT NULL;");
        DB::statement("UPDATE users SET created_at = created_at + INTERVAL '7 hour';");
        DB::statement("UPDATE users SET updated_at = updated_at + INTERVAL '7 hour';");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jalankan hanya jika database PostgreSQL
        if (DB::getDriverName() !== 'pgsql') {
            // Skip migration jika bukan PostgreSQL (misal SQLite untuk test)
            return;
        }
        // Kembalikan ke UTC (kurangi 7 jam)
        DB::statement("UPDATE users SET email_verified_at = email_verified_at - INTERVAL '7 hour' WHERE email_verified_at IS NOT NULL;");
        DB::statement("UPDATE users SET created_at = created_at - INTERVAL '7 hour';");
        DB::statement("UPDATE users SET updated_at = updated_at - INTERVAL '7 hour';");
    }
};
