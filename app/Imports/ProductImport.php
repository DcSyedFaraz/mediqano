<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation, WithProgressBar,WithChunkReading
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */



    /**
     * Generate custom article number.
     *
     * @return string
     */
    public function rules(): array
    {
        return [
            // 'name' => [
            //     'required',
            //     'string',
            // ],
        ];
    }
    private function generateCustomArticleNumber()
    {
        $lastProduct = Product::orderBy('id', 'desc')->first();
        $lastArticleNumber = $lastProduct ? (int) substr($lastProduct->custom_article_number, 2) : 10001000;

        // Increment the last article number
        $newArticleNumber = $lastArticleNumber + 1;

        // Return with the prefix "MQ"
        return "MQ$newArticleNumber";
    }
    public function headingRow(): int
    {
        return 2;  // Assuming the first row is the header row
    }
    public function model(array $row)
    {


        // dump($row);
        // Generate a unique article number
        $customArticleNumber = $this->generateCustomArticleNumber();
        // dd($formattedRow['artikel_nummer']);  // This will print all the keys in $formattedRow
        return new Product([
            'article_number' => $row['artikel_nummer'],
            'custom_article_number' => $customArticleNumber, // Use the generated custom article number
            'pzn' => $row['pzn'],
            'article_description_1' => $row['artikel_bezeichnung_1'],
            'article_description_2' => $row['artikel_bezeichnung_2'],
            'article_description_3' => $row['artikel_bezeichnung_3'],
            'price_unit' => $row['preiseinheit'],
            'minimum_order_quantity' => $row['mindest_abnahme'],
            'quantity_unit' => $row['mengen_einheit'],
            'tax_code' => $row['mwst_kennzeichen'],
            'retail_price' => $row['empf_endverbraucher_preis'],
            'sales_price' => $row['verkaufspreis'],
            'tier_code' => $row['staffel_code'],
            'quantity_value_1' => $row['mengewert_1'],
            'net_price_discount_1' => $row['nettopreisrabatt_1'],
            'quantity_value_2' => $row['mengewert_2'],
            'net_price_discount_2' => $row['nettopreisrabatt_2'],
            'quantity_value_3' => $row['mengewert_3'],
            'net_price_discount_3' => $row['nettopreisrabatt_3'],
            'is_new' => $row['neuanlagen_seit_letztem_update'],
            'date_new_entry' => $row['datum_der_neuanlage'],
            'price_changed' => $row['preisanderung_seit_letztes_update'],
            'date_last_price_change' => $row['datum_der_letzten_preisanderung'],
            'non_discountable' => $row['nicht_frachtbegunstigt'] == 1,
            'promotion_price' => $row['aktionspreis'],
            'valid_from' => $row['gultig_von'],
            'valid_until' => $row['gultig_bis'],
            'gtin' => $row['gtin'],
        ]);
    }
    /**
     * @inheritDoc
     */

    /**
     * @inheritDoc
     */
    public function chunkSize(): int {
        return 5000;
    }
}
