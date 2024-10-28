<!-- resources/views/categories/show.blade.php -->

@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="container">

            <h1 class="my-4">Category Details</h1>

            <div class="card">
                <div class="card-header">
                    {{ $category->name ?? $category->key }}
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $category->id }}</p>
                    <p><strong>Key:</strong> {{ $category->key ?? 'N/A' }}</p>
                    <p><strong>German (DE):</strong> {{ $category->de ?? 'N/A' }}</p>
                    <p><strong>English (EN):</strong> {{ $category->en ?? 'N/A' }}</p>
                    <p><strong>Dutch (NL):</strong> {{ $category->nl ?? 'N/A' }}</p>
                    <p><strong>French (FR):</strong> {{ $category->fr ?? 'N/A' }}</p>
                    <p><strong>Icon:</strong>
                        @if ($category->icon)
                            <i class="{{ $category->icon }}"></i> {{ $category->icon }}
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Image:</strong><br>
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="img-thumbnail"
                                width="200">
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Created At:</strong> {{ $category->created_at->format('d M Y, H:i') }}</p>
                    <p><strong>Updated At:</strong> {{ $category->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
            </div>

        </div>
    </div>
@endsection
