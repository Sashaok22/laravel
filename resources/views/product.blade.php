@extends('layouts.app')
            @section('content')
                <div style="margin-left:15% " >
                    <form method="post" action="{{route('sort',$tp)}}">
                        <h4>Price</h4>
                        <h7>From: <input name="one" type="text" value="{{$one}}"> To: <input name="two" type="text" value="{{$two}}"></h7>
                        <select name="grad" >
                            <option>Ascending</option>
                            <option>Descending</option>
                        </select>
                        <label style="padding-left: 1%">Discount<input style="margin-left: 1%" name="disk"  value="1" type="checkbox"></label>
                        <label style="padding-left: 1%">Product of the day<input style="margin-left: 1%" name="prday" value="1" type="checkbox"></label>
                        <button type="submit "class="btn btn-success">Apply</button>
                        <input name="type" value="{{$tp}}" type="text"hidden>
                    </form>
                </div>
                <div style="margin:0 14% 0 14% ">
                    @if(!(empty($products))):
                    @foreach($products as $product)
                        <div class="spis" style="position: relative;float: left;">
                            <div class="card" style="width: 18rem; margin: 1rem;">
                                <img class="card-img-top" src="{{asset('/storage/'.$product->imgpath)}}" alt="Card image cap">
                                <div class="card-body" style="height: 200px">
                                    <div>
                                        <div>
                                            <a href="{{ route('product',[$product->type_id,$product]) }}" class="card-link">
                                                <h5 class="card-title">{{$product->title}}</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                        @if($product->discount>0)
                                            <p class="card-title" style="margin:0 2rem;float: left;">Discount: {{$product->discount}}%</p>
                                            <p class="card-title" style="margin:0 2rem;float: left;text-decoration: line-through">Old price: {{\App\Product::where('id',$product->id)->get()->first()->price}} rub</p>
                                            <p class="card-title" style="margin:0 2rem;float: left;">New price: {{\App\Product::where('id',$product->id)->get()->first()->price*(1-$product->discount/100)}} rub</p>
                                        @endif()
                                        @if($product->discount==0)
                                            <p class="card-title" style="margin:0 2rem;float: left;">Price: {{\App\Product::where('id',$product->id)->get()->first()->price}} rub</p>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <p class="card-text" style="margin:0 2rem;float: left">Weight: {{$product->weight}}</p>
                                    </div>
                                    <br>
                                    <div>
                                        <p class="card-title" style="margin:0 2rem;float: left">Type: {{App\Type::find($product->type_id)->title}}</p>
                                    </div>
                                </div>
                                <div style="height: 150px">
                                <ul  class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        ingredient: @foreach($product->ingredients()->get() as $ingredient){{$ingredient->title}} @endforeach</li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
@endsection
