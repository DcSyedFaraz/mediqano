@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center my-4">
                <h1>Categories</h1>
                <a href="{{ route('categories.create') }}" class="btn btn-success">Add New Category</a>
            </div>

            <!-- Display Flash Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>
            @endif

            @if ($categories->isEmpty())
                <div class="alert alert-info">
                    No categories available.
                </div>
            @else
                <table class="table table-bordered table-hover table-striped">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Key</th>
                            <th>German (DE)</th>
                            <th>English (EN)</th>
                            <th>Dutch (NL)</th>
                            <th>French (FR)</th>
                            {{-- <th>Icon</th>
                            <th>Image</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->key ?? '-' }}</td>
                                <td>{{ $category->de ?? '-' }}</td>
                                <td>{{ $category->en ?? '-' }}</td>
                                <td>{{ $category->nl ?? '-' }}</td>
                                <td>{{ $category->fr ?? '-' }}</td>
                                {{-- <td>
                                    @if ($category->icon)
                                        <i class="{{ $category->icon }}"></i> {{ $category->icon }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                            class="img-thumbnail" width="100">
                                    @else
                                        -
                                    @endif
                                </td> --}}
                                <td>
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">
                                        View
                                    </a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $category->id }})">
                                        Delete
                                    </button>
                                    <form id="delete-form-{{ $category->id }}"
                                        action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline-block" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script>
        function confirmDelete(categoryId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        }
    </script>
@endsection
