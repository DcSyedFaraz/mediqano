<?php

namespace App\Console\Commands;

use App\Imports\ImageImport;
use App\Imports\ProductImport;
use App\Models\Product;
use DB;
use Illuminate\Console\Command;
use Log;
use Maatwebsite\Excel\Excel;

class ExcelImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laravel Excel importer';

    public function handle()
    {
        $this->output->title('Starting import');

        // Define file paths
        // $productFile = public_path('excel/PreislisteTest.xlsx');
        // $imageFile = public_path('excel/Artikel-ListeTest.xlsx');

        $productFile = public_path('excel/Preisliste.xlsx');
        $imageFile = public_path('excel/Artikel-Liste 09-2024.xlsx');

        // Start a database transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Import Products
            $this->output->comment('Importing products...');
            (new ProductImport)->withOutput($this->output)->import($productFile);
            $this->output->info('Products imported successfully.');

            // Import Images
            $this->output->comment('Importing images...');
            $imageImport = new ImageImport();
            $imageImport->withOutput($this->output)->import($imageFile);

            $this->output->info('Products updated with images successfully.');

            // Commit the transaction
            DB::commit();

            $this->output->success('Import process completed successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            $this->output->error('Import failed: ' . $e->getMessage());
        }
    }
}
