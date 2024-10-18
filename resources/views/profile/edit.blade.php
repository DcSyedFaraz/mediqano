@extends('layout.app ')
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <div class="p-4 bg-white shadow rounded-lg dark:bg-dark">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <div class="p-4 bg-white shadow rounded-lg dark:bg-dark">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="p-4 bg-white shadow rounded-lg dark:bg-dark">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
