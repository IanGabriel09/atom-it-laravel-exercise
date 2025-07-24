@extends('_layouts.app')

{{-- Page internal styles --}}
@section('internal-styles')

@endsection

{{-- Page content --}}
@section('content')
    <div class="container mt-4">
        <h1>Hello world</h1>
        @include('_components.nav')
    </div>
@endsection

{{-- Page scripts --}}
@section('scripts')

@endsection