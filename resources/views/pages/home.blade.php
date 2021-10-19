@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>

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
                        @foreach ($products as $product)
                            <div class="card ">
                                <div class="card-body">
                                    <h5 class="card-title"> <a class="nav-link" href="product-reviews/{{$product->id}}"> {{$product->name}} </a></h5>
                                    <p class="card-text">{{$product->type}}</p>
                                </div>
                            </div><br>
                        @endforeach  
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
