<!-- resources/views/products/show.blade.php -->

@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="container">

            <h1 class="my-4">Product Details</h1>

            <div class="card">
                <div class="card-header">
                    {{ $product->article_description_1 }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Article Number: {{ $product->article_number }}</h5>
                    <p class="card-text"><strong>Custom Article Number:</strong>
                        {{ $product->custom_article_number ?? 'N/A' }}
                    </p>
                    <p class="card-text"><strong>PZN:</strong> {{ $product->pzn ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Description 1:</strong> {{ $product->article_description_1 }}</p>
                    <p class="card-text"><strong>Description 2:</strong> {{ $product->article_description_2 ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Description 3:</strong> {{ $product->article_description_3 ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Sales Price:</strong> {{ $product->sales_price }}</p>
                    <p class="card-text"><strong>Retail Price:</strong> {{ $product->retail_price }}</p>
                    <p class="card-text"><strong>Price Unit:</strong> {{ $product->price_unit ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Minimum Order Quantity:</strong>
                        {{ $product->minimum_order_quantity ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Quantity Unit:</strong> {{ $product->quantity_unit ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Tax Code:</strong> {{ $product->tax_code ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Tier Code:</strong> {{ $product->tier_code ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Promotion Price:</strong> {{ $product->promotion_price ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Valid From:</strong>
                        {{ $product->valid_from ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Valid Until:</strong>
                        {{ $product->valid_until ?? 'N/A' }}</p>
                    {{-- <p class="card-text"><strong>Valid From:</strong>
                        {{ $product->valid_from ? \Carbon\Carbon::parse($product->valid_from)->format('d.m.Y') : 'N/A' }}</p>
                    <p class="card-text"><strong>Valid Until:</strong>
                        {{ $product->valid_until ? \Carbon\Carbon::parse($product->valid_until)->format('d.m.Y') : 'N/A' }}</p> --}}
                    <p class="card-text"><strong>GTIN:</strong> {{ $product->gtin ?? 'N/A' }}</p>

                    @php
                        // Define the path to the image
                        $imagePath = public_path('product_picutres/' . $product->image);
                    @endphp
                    {{-- @dd($imagePath,file_exists($imagePath)) --}}
                    @if ($product->image && file_exists($imagePath))
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-thumbnail w-25 mt-2">
                    @else
                        <p class="mt-2">No image available.</p>
                    @endif
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="categories" class="form-label">Assign Categories</label>
                            <select class="form-select select2 @error('categories') is-invalid @enderror" id="categories"
                                name="categories[]" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', $productCategories)) ? 'selected' : '' }}>
                                        {{ $category->en ?? $category->key }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Hold down the Ctrl (Windows) or Command (Mac) button to select multiple categories.
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>

                </div>
                <div class="card-footer text-muted">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
@endsection
