@extends('app')
@section('css')
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 200px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

        .inline-edit {
            cursor: pointer;
        }

        .inline-edit:hover {
            color: green;
        }
    </style>
@endsection
@section('content')
    <div class="row mt-5">
        <h1 class="display-3 d-flex justify-content-center"><strong> Product</strong></h1>
    </div>
    @include('product.create')
    @include('product.list')
    @include('product.edit')
@endsection

@section('scripts')
    <script>
        let productListUrl = '{{ route("product.list") }}';
        let productCreateUrl = '{{ route("product.store") }}';
        let productUpdateUrl = '{{ route("product.update") }}';
        let csrfToken = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('product.js') }}"></script>
    <script>
       
    </script>
@endsection
