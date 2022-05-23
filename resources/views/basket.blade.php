@extends('layouts.app')
@section('content')
    <script>
        var flag=1;
    </script>
    <div  class="container" style="border: solid black">
        <div class="border-bottom border-dark">
            <div class="row justify-content-md-center">

                <table class="table table-sm" style="margin-bottom: 0" >
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Count</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sum</th>
                        <th scope="col">Button</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bask->products()->get() as $prod)
                        <tr id="objtodel{{$prod->id}}" style="background-color: grey;color: white">
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$prod->title}}</td>
                            <td>{{$prod->pivot->number}}x</td>
                            <td>{{$prod->price*(1-$prod->discount/100)}}</td>
                            <td>{{$prod->price*$prod->pivot->number*(1-$prod->discount/100)}}</td>
                            <input hidden id="min{{$prod->id}}" value="{{$prod->price*$prod->pivot->number}}">
                            <input hidden value="{{$sum+=$prod->price*$prod->pivot->number*(1-$prod->discount/100)}}">
                            <td>
                                <form method="delete" style="width: 100%">
                                    <button  onclick="dot({{$prod->id}})"  type="button" class="btn btn-primary" >
                                        <script>function dot(k)
                                            {
                                                var s =k;
                                                $.ajax({
                                                    type: 'delete',
                                                    url: '{{route('delfrombasket')}}',
                                                    data: {id:s},
                                                    success: function (data) {
                                                        var l = document.getElementById('min'+s);
                                                        if(flag==1) {
                                                            var sum = '{{$sum}}';
                                                            flag=0;
                                                        }
                                                        var tot =document.getElementById('total');
                                                        sum-=l.value;
                                                        if(isNaN(sum) || sum==0)
                                                        {
                                                            tot.value = 0 +'rub';
                                                            var dis = document.getElementById('dis');
                                                            dis.setAttribute("disabled", "disabled");
                                                        }
                                                        else
                                                        {
                                                            tot.value=sum+' rub';
                                                        }
                                                        var o = document.getElementById('objtodel'+s);
                                                        o.remove();
                                                    },
                                                });
                                            }
                                        </script>
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr bgcolor=black>
                        <th scope="row" bgcolor=black STYLE="color: white">Total</th>
                        <td bgcolor=black></td>
                        <td bgcolor=black></td>
                        <td bgcolor=black></td>
                        <td bgcolor=black></td>
                        <td bgcolor=black>
                            <form method="post" action="{{route('sendmail')}}" enctype="multipart/form-data">
                                <input name="price" class="form-control" disabled type="text"value="{{$sum}} rub" id='total'style="width: 20%;text-align: center;float: left">
                                <button id="dis" type="submit"class="btn btn-primary" style="width: 20%;float: left;margin-left: 1%">Buy</button>
                                <input name="number" class="form-control" type="text" value="{{$sum}}" hidden>
                                <input name="bask" class="form-control" type="text" value="{{$bask}}" hidden>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>

        </div>
    </div>

@endsection
