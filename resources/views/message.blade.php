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
                            Thank you for your purchase. Check sent to Email:{{\App\User::find(Auth::id())->email}}.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
