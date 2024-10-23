<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Product;
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
        // Fetch all products, consider adding pagination
        $products = Product::paginate(10);

        // Return the index view with products data
        return view('products.index', compact('products'));
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Find the product by ID or fail with 404
        $product = Product::findOrFail($id);

        // Return the show view with product data
        return view('products.show', compact('product'));
    }
}
