
@extends('layouts.app')
@section('content')
    <div hidden>
        <?php
        $baskid = '';
        $us ='';
        ?>
        {{$baskid =\App\BasketProduct::where('product_id',$product->id)->get()->first()}}
        @if(\App\BasketProduct::where('product_id',$product->id)->get()->first() &&
        \Illuminate\Support\Facades\Auth::user()->basket()->find($baskid->basket_id)):
        {{$prod = true}};
    @endif
    </div>
    <div hidden>
        <?php
        $fl2 = 1;
        ?>
        @if((\Illuminate\Support\Facades\Auth::check())):
        @if(\Illuminate\Support\Facades\Auth::user()->role=='admin'):
        {{$fl2 = 0}};
        @endif
        @endif
    </div>
    <style>
        button
        {
            width: 200px;
        }
    </style>
    <div class="container" style="margin: 0">
        <div class="border-bottom border-dark">
            <div >
                <div >
                    <img style="width: 50%; height: 400px;float: left;border: solid black;margin-left-left: 20px" class="card-img-top" src="{{asset('/storage/'.$product->imgpath)}}" alt="Card image cap">
                    <div style="margin-left: 5%">
                    <h1>Title: {{$product->title}}</h1>
                        @if($product->discount>0)
                            <h2 class="card-title" style="margin:0 2rem;float: left;">Discount: {{$product->discount}}%</h2>
                            <h2 class="card-title" style="margin:0 2rem;float: left;text-decoration: line-through">Old price: {{\App\Product::where('id',$product->id)->get()->first()->price}} rub</h2>
                            <h2 class="card-title" style="margin:0 2rem;float: left;">New price: {{\App\Product::where('id',$product->id)->get()->first()->price*(1-$product->discount/100)}} rub</h2>
                        @endif()
                        @if($product->discount==0)
                            <h2 class="card-title" style="margin:0 2rem;float: left;">Price: {{\App\Product::where('id',$product->id)->get()->first()->price}} rub</h2>
                        @endif
                    <h3>Ingredients: @foreach($product->ingredients()->get() as $ing)
                            {{$ing->title}}
                        @endforeach
                    </h3>
                    </div>
                    <div  style="float: bottom">
                        <div  >
                            <form id="save" method="post" style="float: left;position: relative" >
                                @csrf
                                <div id="norm">
                                    <p style="width: 20%; margin-bottom: 0">Count</p>
                                    <input style="float: left;width: 20%;position: relative" name="number" class="form-control" type="text" value="1">
                                    <button style="float: left;position: relative" type="submit" class="btn btn-primary" >Add to Basket</button>
                                    <input style="float: left;position: relative" name="product_id" class="form-control" type="text" value="{{$product->id}}" hidden>
                                    <input id="flag" class="form-control" type="text" value="{{$prod}}" hidden>
                                </div>

                                <div id="msg" style="display: none">
                                    <strong style="float: left;border: solid black;height: 38px;background-color: white;position: relative">Product added</strong>
                                </div>
                            </form>
                            <div style="float:left;">
                            <form id="del2" method="get" action="{{route('InsProd')}}" style="float:left;position: relative">
                                @csrf
                                <button id="flag3" style="float: left;position: relative" value="{{$fl2}}" type="submit" class="btn btn-warning" >Change product</button>
                                <input name="product_id" class="form-control" type="text" value="{{$product->id}}" hidden>
                            </form>
                            <form id="del" style="float:left;position: relative"method="post" action="{{route('delprod',[$product->type,$product->id])}}">
                                @csrf
                                <button id="flag2" style="float: left;position: relative" value="{{$fl2}}" type="submit" class="btn btn-danger" >Delete product</button>
                                <input name="product_id" class="form-control" type="text" value="{{$product->id}}" hidden>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-auto">

            </div>
            <div class="row" onload="hide()">

            </div >
        </div>

    </div>
<script>
    $(document).ready(function () {
        $('#save').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/addtobasket',
                data: $('#save').serialize(),
                success: function (data) {
                    $('#norm').hide();
                    $('#msg').show();
                },
            });
        });
    });
    l=document.getElementById('flag');
    if(l.value==1)
    {
        $('#norm').hide();
        $('#msg').show();
    }
    l=document.getElementById('flag2');
    if(l.value==1)
    {
        $('#del').hide();
    }
    l=document.getElementById('flag3');
    if(l.value==1)
    {
        $('#del2').hide();
    }

</script>
@endsection


