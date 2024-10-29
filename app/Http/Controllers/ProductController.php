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
        $products = Product::select('id', 'article_number', 'article_description_1', 'sales_price', 'retail_price', 'custom_article_number')->whereNotNull('image')->paginate(10);


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

        $product = Product::with([
            'updateDate',
            'categories',
            'translations',
            'categoryTranslations'
        ])->findOrFail($id);

        $categories = Category::all();
        $productCategories = $product->categories->pluck('id')->toArray();

        return view('products.show', compact('product', 'categories', 'productCategories'));
    }
    public function noImageIndex()
    {

        $products = Product::select('id', 'article_number', 'article_description_1', 'sales_price', 'retail_price', 'custom_article_number')->whereNull('image')->paginate(10);


        return view('products.index', compact('products'));
    }
    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);


        if (isset($validated['categories'])) {
            $product->categories()->sync($validated['categories']);
        } else {
            $product->categories()->detach();
        }


        return redirect()->back()
            ->with('success', 'Product updated successfully.');
    }


}
