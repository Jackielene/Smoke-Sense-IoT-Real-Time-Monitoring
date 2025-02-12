<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_smoke_levels_table.php
    public function up()
    {
        Schema::create('smoke_levels', function (Blueprint $table) {
            $table->id();
            $table->float('level');
            $table->boolean('alert')->default(false); // Store whether the smoke level exceeded threshold
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smoke_levels');
    }
};
