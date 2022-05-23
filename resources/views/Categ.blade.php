@extends('layouts.app')
@section('content')
<div class="wrapper">
    <div class="main_block">

        <div class="container">

            <div class="menu_list row">
                @foreach($produc as $product)
                <div class="item col-md-6" id="bx_1847241719_4" style="background-color: dodgerblue">
                    <div class="inner">
                        <a style="color: black" title="{{$product->title}}" href="{{route('products',[$product])}}">
                            <div class="photo">
                                <img style="width: 50%;height: 200px" class="card-img-top" src="{{asset('/storage/'.$product->imgpath)}}" alt="Card image cap">
                                <div style="float:right;" class="title"><h1 style="font-size: 20px;padding-top: 60px;padding-right: 70px">{{$product->title}}</h1></div>
                            </div>

                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
