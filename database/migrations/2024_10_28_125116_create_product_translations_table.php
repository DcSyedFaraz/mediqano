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
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->string('article_number')->nullable();
            $table->string('LanguageCode')->nullable();
            $table->string('ProductName')->nullable();
            $table->text('Description')->nullable();
            $table->string('FilterWords')->nullable();
            $table->text('HTML_Description')->nullable();
            $table->text('META_Description')->nullable();
            $table->text('KEYWORD_Description')->nullable();
            $table->text('SEARCHWORDS_Description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_translations');
    }
};
