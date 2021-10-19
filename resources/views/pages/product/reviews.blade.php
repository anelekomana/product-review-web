@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $product->name }} Reviews</div>

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
                    @if (count($reviews) > 0)
                        @foreach ($reviews as $review)
                        <div class="card">
                            <div class="card-header">
                              Rating : {{$review->rating}}
                            </div>
                            <div class="card-body">
                                <p>{{$review->review}}</p>
                                @auth
                                    <form method="POST" action="/delete-review/{{$review->id}}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('DELETE') }}
                                        </button>
                                    </form>
                                @endauth
                            </div>
                          </div><br>
                        @endforeach  
                    @else 
                        <center><p>No reviews found</p> </center> 
                    @endif
                    @auth
                        <hr>
                        <center><h5>Add Review</h5> </center>
                        <form method="POST" action="/create-review/{{$product->id}}">
                            @csrf
                            <div class="form-group row">
                                <label for="rating" class="col-md-4 col-form-label text-md-right">{{ __('Rating') }}</label>

                                <div class="col-md-6">
                                    <select id="rating" class="form-control @error('rating') is-invalid @enderror" name="rating" value="{{ old('rating') }}" required autocomplete="rating" autofocus>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    @error('rating')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="review" class="col-md-4 col-form-label text-md-right">{{ __('Review') }}</label>

                                <div class="col-md-6">
                                    <textarea id="review" class="form-control @error('review') is-invalid @enderror" name="review" value="{{ old('review') }}" required>
                                    </textarea>
                                    @error('review')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
