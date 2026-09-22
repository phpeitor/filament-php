<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('type')->default('agent');
            $table->string('status')->default('active');
        });

        // Existing panel users were administrators before roles were introduced.
        DB::table('users')->update([
            'type' => 'admin',
            'status' => 'active',
        ]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['type', 'status']);
        });
    }
};
