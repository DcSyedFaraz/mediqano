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
                    <!-- Add more fields as necessary -->
                </div>
                <div class="card-footer text-muted">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
@endsection
