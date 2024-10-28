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
        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->string('article_number')->nullable();
            $table->string('CategoryLanguageCode')->nullable();
            $table->string('CategoryLevel1')->nullable();
            $table->string('CategoryLevel2')->nullable();
            $table->string('CategoryLevel3')->nullable();
            $table->string('CategoryLevel4')->nullable();
            $table->text('CategoryDescription')->nullable();
            $table->string('CategoryKeyword')->nullable();
            $table->string('CategoryTitle')->nullable();
            $table->string('CategoryURL')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_translations');
    }
};
