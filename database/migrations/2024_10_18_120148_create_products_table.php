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
            $table->text('custom_article_number')->nullable();   // Artikel-Nummer
            $table->text('article_number')->nullable();   // Artikel-Nummer
            $table->text('pzn')->nullable();              // PZN
            $table->text('article_description_1')->nullable();  // Artikel-Bezeichnung 1
            $table->text('article_description_2')->nullable();  // Artikel-Bezeichnung 2
            $table->text('article_description_3')->nullable();  // Artikel-Bezeichnung 3
            $table->text('price_unit')->nullable();      // Preiseinheit
            $table->text('minimum_order_quantity')->nullable();  // Mindest-abnahme
            $table->text('quantity_unit')->nullable();    // Mengen-einheit
            $table->text('tax_code')->nullable();        // MwSt.-kennzeichen
            $table->text('retail_price')->nullable();  // empf. Endverbraucher-preis
            $table->text('sales_price')->nullable();  // Verkaufspreis
            $table->text('tier_code')->nullable();        // Staffel-Code
            $table->text('quantity_value_1')->nullable();  // Menge/Wert 1
            $table->text('net_price_discount_1')->nullable();  // Nettopreis/Rabatt 1
            $table->text('quantity_value_2')->nullable();  // Menge/Wert 2
            $table->text('net_price_discount_2')->nullable();  // Nettopreis/Rabatt 2
            $table->text('quantity_value_3')->nullable();  // Menge/Wert 3
            $table->text('net_price_discount_3')->nullable();  // Nettopreis/Rabatt 3
            $table->text('is_new')->nullable();       // Neuanlagen seit letztem Uptext
            $table->text('date_new_entry')->nullable();      // Datum der Neuanlage
            $table->text('price_changed')->nullable();  // Preisänderung seit letztes Uptext
            $table->text('date_last_price_change')->nullable();  // Datum der letzten Preisänderung
            $table->text('non_discountable')->nullable();  // NICHT FRACHTBEGÜNSTIGT
            $table->text('promotion_price')->nullable();  // Aktionspreis
            $table->text('valid_from')->nullable();          // gültig von
            $table->text('valid_until')->nullable();         // gültig bis
            $table->text('gtin')->nullable();               // GTIN
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
