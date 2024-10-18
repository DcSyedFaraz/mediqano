<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ProductController extends Controller
{
    protected $excel;

    // Inject Excel into the constructor
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function index()
    {
        // Define the file path
        $file = public_path('excel/PreislisteTest.xlsx');

        // Import the file using the non-static method
        $this->excel->import(new ProductImport, $file);

        return redirect()->route('dashboard')->with('success', 'Excel file imported successfully!');
    }
}
