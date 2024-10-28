<?php

namespace App\Http\Controllers;

use App\Imports\ImageImport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function index()
    {
        // $imageFile = public_path('excel/Artikel-Liste 09-2024.xlsx');
        // $imageImport = new ImageImport();
        // $imageImport->import($imageFile);
        // $images = $imageImport->getImages();
        // dd($images);
        // Fetch all products, consider adding pagination
        $products = Product::select('id', 'article_number', 'article_description_1', 'sales_price', 'retail_price', 'custom_article_number')->whereNotNull('image')->paginate(10);

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
        $categories = Category::all(); // Fetch all categories
        $productCategories = $product->categories->pluck('id')->toArray();
        // Return the show view with product data
        return view('products.show', compact('product', 'categories', 'productCategories'));
    }
    public function noImageIndex()
    {

        $products = Product::select('id', 'article_number', 'article_description_1', 'sales_price', 'retail_price', 'custom_article_number')->whereNull('image')->paginate(10);

        // Return the index view with products data
        return view('products.noimage.index', compact('products'));
    }
    public function update(Request $request, Product $product)
    {
        // Validate input (add validation rules as needed)
        $validated = $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Sync categories
        if (isset($validated['categories'])) {
            $product->categories()->sync($validated['categories']);
        } else {
            $product->categories()->detach(); // Remove all categories if none selected
        }

        // Redirect with success message
        return redirect()->back()
            ->with('success', 'Product updated successfully.');
    }

    
}
