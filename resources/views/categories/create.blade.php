<!-- resources/views/categories/create.blade.php -->

@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="container">

            <h1 class="my-4">Add New Category</h1>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Please fix the following issues:
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @include('categories.partials.form')

                <button type="submit" class="btn btn-primary">Create Category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>
@endsection
