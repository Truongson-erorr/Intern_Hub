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
            $table->text('experience')->nullable();
            $table->string('expected_salary')->nullable();
            $table->text('skills')->nullable();
            $table->string('education')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'experience',
                'expected_salary',
                'skills',
                'education',
            ]);
        });
    }
};
