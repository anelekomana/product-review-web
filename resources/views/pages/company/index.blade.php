@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Companies') }} &nbsp;&nbsp;
                    @role('admin')
                        <a class="btn btn-primary" href="/create-company" role="button">CREATE COMPANY</a>
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
                    @if (count($companies) > 0)
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <th><a class="nav-link" href="view-company/{{$company->id}}"> {{$company->name}} </a></th>
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
