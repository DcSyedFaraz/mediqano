@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="container">

            <h1 class="my-4">Product Details</h1>

            <div class="card mb-4">
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
                    <p class="card-text"><strong>GTIN:</strong> {{ $product->gtin ?? 'N/A' }}</p>

                    @php
                        // Define the path to the image
                        $imagePath = public_path('product_pictures/' . $product->image);
                    @endphp
                    {{-- @dd($imagePath,file_exists($imagePath)) --}}
                    @if ($product->image && file_exists($imagePath))
                        <img src="{{ asset('product_pictures/' . $product->image) }}"
                            alt="{{ $product->article_description_1 }}" class="img-thumbnail w-25 mt-2">
                    @else
                        <p class="mt-2">No image available.</p>
                    @endif

                    <!-- Assign Categories Form -->
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
                                        {{ $category->key }}
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

                <!-- Product Translations Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Translations
                    </div>
                    <div class="card-body table-responsive">
                        @if ($product->translations->isNotEmpty())
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Language Code</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Filter Words</th>
                                        <th>HTML Description</th>
                                        <th>META Description</th>
                                        <th>KEYWORD Description</th>
                                        <th>SEARCHWORDS Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->translations as $translation)
                                        <tr>
                                            <td>{{ $translation->LanguageCode }}</td>
                                            <td>{{ $translation->ProductName }}</td>
                                            <td>{{ $translation->Description }}</td>
                                            <td>{{ $translation->FilterWords }}</td>
                                            <td>{!! $translation->HTML_Description !!}</td>
                                            <td>{{ $translation->META_Description }}</td>
                                            <td>{{ $translation->KEYWORD_Description }}</td>
                                            <td>{{ $translation->SEARCHWORDS_Description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No product translations available.</p>
                        @endif
                    </div>
                </div>

                <!-- Category Translations Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        Category Translations
                    </div>
                    <div class="card-body table-responsive">
                        @if ($product->categoryTranslations->isNotEmpty())
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Language Code</th>
                                        <th>Category Level 1</th>
                                        <th>Category Level 2</th>
                                        <th>Category Level 3</th>
                                        <th>Category Level 4</th>
                                        <th>Category Description</th>
                                        <th>Category Keyword</th>
                                        <th>Category Title</th>
                                        <th>Category URL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->categoryTranslations as $translation)
                                        <tr>
                                            <td>{{ $translation->CategoryLanguageCode }}</td>
                                            <td>{{ $translation->CategoryLevel1 }}</td>
                                            <td>{{ $translation->CategoryLevel2 ?? 'N/A' }}</td>
                                            <td>{{ $translation->CategoryLevel3 ?? 'N/A' }}</td>
                                            <td>{{ $translation->CategoryLevel4 ?? 'N/A' }}</td>
                                            <td>{{ $translation->CategoryDescription }}</td>
                                            <td>{{ $translation->CategoryKeyword }}</td>
                                            <td>{{ $translation->CategoryTitle }}</td>
                                            <td>{{ $translation->CategoryURL }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No category translations available.</p>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
                </div>
            </div>


        </div>
    </div>
@endsection
