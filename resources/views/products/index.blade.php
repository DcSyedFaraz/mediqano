<!-- resources/views/products/index.blade.php -->

@extends('layout.app')

@section('content')
    <div class="content-wrapper">

        <h1 class="mb-4">Products</h1>

        @if ($products->isEmpty())
            <div class="alert alert-info">
                No products available.
            </div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Article Number</th>
                        <th>Description</th>
                        <th>Sales Price</th>
                        <th>Retail Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->article_number }}</td>
                            <td>{{ $product->article_description_1 }}</td>
                            <td>{{ $product->sales_price }}</td>
                            <td>{{ $product->retail_price }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">
                                    View
                                </a>
                                <!-- Add more actions if needed -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
