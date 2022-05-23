@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>There are no products in your basket yet.</p>
                    <p>Go to the store tab and add the product to the basket to purchase it.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
