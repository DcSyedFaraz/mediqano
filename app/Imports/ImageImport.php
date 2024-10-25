<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class ImageImport implements ToCollection, WithProgressBar
{
    use Importable;
    protected $images = [];

    public function collection(Collection $rows)
    {
        // dd($rows);
        $rows->shift();
        // echo $rows;
        foreach ($rows as $row) {
            $articleNumber = $row[0]; // Adjust index as needed
            $imagePath = $row[1];
            $this->images[$articleNumber] = $imagePath;
        }
    }

    /**
     * Get the imported images data.
     *
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }
}
