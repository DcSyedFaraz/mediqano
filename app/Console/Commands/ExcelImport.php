<?php

namespace App\Console\Commands;

use App\Imports\ProductImport;
use Illuminate\Console\Command;
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
        $file = public_path('excel/Preisliste.xlsx');
        (new ProductImport)->withOutput($this->output)->import($file);
        $this->output->success('Import successful');
    }
}
