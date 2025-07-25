@extends('_layouts.app')

{{-- Page internal styles --}}
@section('internal-styles')

@endsection

{{-- Page content --}}
@section('content')
    <div class="container">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <form action="{{ route('auth.signIn') }}" method="POST">
                @csrf
                <div class="bg-white p-5 card rounded"> 

                    <h3 class="text-center fw-bold">Sign In</h3>
                    <div class="mb-3">
                        <label for="">Username:</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <!-- Display session messages (success, error, etc.) -->
                    @if (session('message'))
                        <p class="text-success"><i>{{ session('message') }}</i></p>
                    @endif

                    <!-- Display centralized error message -->
                    @if ($errors->has('message'))
                        <p class="text-danger"><i>{{ $errors->first('message') }}</i></p>
                    @endif

                    <div class="d-flex justify-content-center align-items-center">
                        <input type="submit" class="btn btn-success" value="Login">
                    </div>

                </div>
            </form>
        </div>

    </div>
@endsection

{{-- Page scripts --}}
@section('scripts')

@endsection