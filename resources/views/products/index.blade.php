<!-- resources/views/products/index.blade.php -->

@extends('layout.app')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.jqueryui.min.css">
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.jqueryui.min.js"></script> --}}
@section('content')
    <div class="content-wrapper">
        <div class="container">

            <h1 class="my-4">Products</h1>

            @if ($products->isEmpty())
                <div class="alert alert-info">
                    No products available.
                </div>
            @else
                <table class="table table-bordered table-hover table-striped">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Custom Article Number</th>
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
                                <td>{{ $product->custom_article_number }}</td>
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
    </div>
    {{-- <script>
        new DataTable('#example');
    </script> --}}
@endsection
