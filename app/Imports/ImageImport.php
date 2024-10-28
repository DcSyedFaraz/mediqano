<?php

namespace App\Imports;

use App\Models\Product;
use DB;
use Illuminate\Support\Collection;
use Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class ImageImport implements ToCollection, WithProgressBar, WithChunkReading
{
    use Importable;
    protected $images = [];

    public function collection(Collection $rows)
    {
        // dd($rows);
        $rows->shift();
        // echo $rows;
        // foreach ($rows as $row) {
        //     $articleNumber = $row[0]; // Adjust index as needed
        //     $imagePath = $row[1];
        //     $this->images[$articleNumber] = $imagePath;
        // }
        $imageUpdates = [];

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
                    $product->image = $imageUpdates[$product->article_number];
                    $product->save();

                    // Optionally, unset the processed article number
                    unset($imageUpdates[$product->article_number]);
                }

                // Handle unmatched article numbers
                if (!empty($imageUpdates)) {
                    Log::warning('Unmatched Article Numbers during Image Import:', array_keys($imageUpdates));
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
     * @inheritDoc
     */
    public function chunkSize(): int
    {
        return 500;
    }
}
