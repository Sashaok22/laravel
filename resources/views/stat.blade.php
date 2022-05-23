@extends('layouts.app')
@section('content')
    <div hidden>
        <?php
        $h ='';
        $summ =0;
        ?>
    </div>
    <div style="margin-left:15% "  >
        <form method="post" style="margin-left: 27%" action="{{route('sort2')}}">
            <label>From:<input name="from" type="date"></label>
            <label>To:<input name="to" type="date"></label>
            <button type="submit "class="btn btn-success">Apply</button>
        </form>
    </div>
    <h1 style="margin-left: 1%">Purchases:</h1>
    @if(!(empty($stat)))
        <table class="table table-sm" style="margin-bottom: 0;width: 50%;margin-left: 30%" >
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Email</th>
                <th scope="col">Price</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stat as $sal)
                <tr style="background-color: #385d7a;color: white">
                    <th scope="row">{{$loop->index+1}}</th>
                    <td hidden>{{$h=$sal->user()->first()}}</td>
                    <td>{{$h->email}}</td>
                    <td>{{$sal->price}}</td>
                    <td hidden>{{$summ+=$sal->price}}</td>
                    <td>{{$sal->created_at}}</td>
                </tr>
            @endforeach
            <tr style="background-color: #b91d19;color: white">
                <th scope="row">Total:</th>
                <td></td>
                <td></td>
                <td>{{$summ}}</td>
            </tr>
            </tbody>
        </table>
@endif
    @if((empty($stat)))
        <h1>No result</h1>
        @endif

    <h1 style="margin-left: 1%">Registration:</h1>
    @if(!(empty($use)))
    <table class="table table-sm" style="margin-bottom: 0;width: 50%;margin-left: 30%" >
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($use as $sal)
            <tr style="background-color: #385d7a;color: white">
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$sal->name}}</td>
                <td>{{$sal->email}}</td>
                <td>{{$sal->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    @if((empty($use)))
        <h1>No result</h1>
    @endif

@endsection



