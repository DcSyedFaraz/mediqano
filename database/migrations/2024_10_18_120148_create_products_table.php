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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('custom_article_number')->nullable();   // Artikel-Nummer
            $table->string('article_number')->nullable();   // Artikel-Nummer
            $table->string('pzn')->nullable();              // PZN
            $table->string('article_description_1')->nullable();  // Artikel-Bezeichnung 1
            $table->string('article_description_2')->nullable();  // Artikel-Bezeichnung 2
            $table->string('article_description_3')->nullable();  // Artikel-Bezeichnung 3
            $table->string('price_unit')->nullable();      // Preiseinheit
            $table->string('minimum_order_quantity')->nullable();  // Mindest-abnahme
            $table->string('quantity_unit')->nullable();    // Mengen-einheit
            $table->string('tax_code')->nullable();        // MwSt.-kennzeichen
            $table->string('retail_price')->nullable();  // empf. Endverbraucher-preis
            $table->string('sales_price')->nullable();  // Verkaufspreis
            $table->string('tier_code')->nullable();        // Staffel-Code
            $table->string('quantity_value_1')->nullable();  // Menge/Wert 1
            $table->string('net_price_discount_1')->nullable();  // Nettopreis/Rabatt 1
            $table->string('quantity_value_2')->nullable();  // Menge/Wert 2
            $table->string('net_price_discount_2')->nullable();  // Nettopreis/Rabatt 2
            $table->string('quantity_value_3')->nullable();  // Menge/Wert 3
            $table->string('net_price_discount_3')->nullable();  // Nettopreis/Rabatt 3
            $table->string('is_new')->nullable();       // Neuanlagen seit letztem Upstring
            $table->string('date_new_entry')->nullable();      // Datum der Neuanlage
            $table->string('price_changed')->nullable();  // Preisänderung seit letztes Upstring
            $table->string('date_last_price_change')->nullable();  // Datum der letzten Preisänderung
            $table->string('non_discountable')->nullable();  // NICHT FRACHTBEGÜNSTIGT
            $table->string('promotion_price')->nullable();  // Aktionspreis
            $table->string('valid_from')->nullable();          // gültig von
            $table->string('valid_until')->nullable();         // gültig bis
            $table->string('gtin')->nullable();               // GTIN
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
