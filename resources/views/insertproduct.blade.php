@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div hidden>
        <?php
        $ingr = "";
        $in = "";
        ?>
            @foreach($req->ingredients()->get() as $ing)
                {{$in=$ing->title}}
                <?php
                $ingr = $ingr. " ";
                $ingr = $ingr.  $in;
                ?>
            @endforeach
    </div>
    <h1 style="margin-left: 42%;">New product</h1>
    <div class="content">
        <div class="container">
            <form method="post" action="{{route('insertProduct')}}" enctype="multipart/form-data" style="width: 40%;margin-left: 30%">
                <div class="form-group">
                    Choose image for product:
                    <input class="form-control"  type="file" name="image">
                    <input class="form-control" id="text"value="{{$req->imgpath}}" name="oldpath" hidden>
                </div>
                <div class="form-group">
                    @csrf
                    Enter the title:
                    <input class="form-control" id="text"value="{{$req->title}}" name="title">
                </div>
                <div class="form-group">
                    Enter weight:
                    <input class="form-control" id="text"value="{{$req->weight}}" name="weight">
                </div>
                <div class="form-group">
                    Enter price:
                    <input class="form-control" type="text" value="{{$req->price}}" name="price">
                    <input class="form-control" type="text" value="{{$req->id}}" name="id" hidden>
                </div>
                <div class="form-group">
                    Enter type:
                    <select name="type" class="form-control">
                        @foreach($ings as $ing)
                            <option value={{$ing->id}}>{{$ing->title}}</option>
                        @endforeach;
                    </select>
                </div>
                <div class="form-group">
                    Enter ingredients:
                    <input class="form-control" value="{{$ingr}}" type="text" name="ingredients">
                </div>
                <div class="form-group">
                    Enter discount:
                    <input class="form-control" value="{{$req->discount}}" type="text" name="discount" >
                </div>
                <div class="form-group">
                    Product of the day:
                    <input class="form-control" value="1" type="checkbox" name="prday" style="width: 30px;height: 30px">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>

    </div>

@endsection
