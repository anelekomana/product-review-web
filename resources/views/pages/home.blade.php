@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Products') }} &nbsp;&nbsp;
                    @role('admin')
                        <a class="btn btn-primary" href="/create-product" role="button">CREATE PRODUCT</a>
                    @endrole
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (count($products) > 0)
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Company</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <th><a class="nav-link" href="product-reviews/{{$product->id}}"> {{$product->name}} </a></th>
                                    <td>{{$product->type}}</td>
                                    <th><a class="nav-link" href="view-company/{{$product->company->id}}"> {{$product->company->name}} </a></th>
                                </tr>
                                @endforeach  
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
