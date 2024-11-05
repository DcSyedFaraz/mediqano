<?php

namespace App\Imports;

use App\Models\Product;
use DB;
use Illuminate\Support\Collection;
use Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImageImport implements ToCollection, WithProgressBar, WithChunkReading
{
    use Importable;

    protected $images = [];

    public function collection(Collection $rows)
    {
        // Remove the header row
        $rows->shift();

        $imageUpdates = [];

        // Build an associative array of article numbers and image paths
        foreach ($rows as $row) {
            $articleNumber = $row[0] ?? null;
            $imagePath = $row[1] ?? null;

            if ($articleNumber && $imagePath) {
                $imageUpdates[$articleNumber] = $imagePath;
            }
        }

        if (!empty($imageUpdates)) {
            // Fetch all products that match the article numbers
            $products = Product::whereIn('article_number', array_keys($imageUpdates))->get();

            // Start a database transaction
            DB::beginTransaction();

            try {
                foreach ($products as $product) {
                    $newImagePath = $imageUpdates[$product->article_number];

                    // Full path to the image
                    $fullImagePath = public_path("product_pictures/$newImagePath");

                    // Check if the image file exists
                    if (file_exists($fullImagePath)) {
                        // Update the product's image
                        $product->image = $newImagePath;
                        $product->save();

                        // Optionally, unset the processed article number
                        unset($imageUpdates[$product->article_number]);
                    } else {
                        // Log a warning if the image file does not exist
                        Log::warning("Image file does not exist for Article Number: {$product->article_number}. Expected path: {$fullImagePath}");
                    }
                }

                // Handle unmatched article numbers or images that were skipped
                if (!empty($imageUpdates)) {
                    // These are article numbers that were not found in the products table
                    $unmatchedArticles = array_keys($imageUpdates);
                    Log::warning('Unmatched Article Numbers during Image Import:', $unmatchedArticles);
                }

                // Commit the transaction
                DB::commit();
            } catch (\Exception $e) {
                // Rollback in case of error
                DB::rollBack();
                Log::error('Error during Image Import: ' . $e->getMessage());
                throw $e;
            }
        }
    }

    /**
     * Define the chunk size for reading the Excel file.
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 500;
    }
}
