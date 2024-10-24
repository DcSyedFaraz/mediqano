<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function index()
    {
        // Fetch all products, consider adding pagination
        $products = Product::select('id','article_number','article_description_1','sales_price','retail_price','custom_article_number')->paginate(10);

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
