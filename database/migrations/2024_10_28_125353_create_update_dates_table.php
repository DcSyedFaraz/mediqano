<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('update_dates', function (Blueprint $table) {
            $table->id();
            $table->string('article_number')->nullable();
            $table->string('UpdateDateMake')->nullable();
            $table->string('UpdateDateAPI')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_dates');
    }
};
