@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-10">

            @if(session('msg'))
                <div class="alert alert-success" role="alert">
                    {{ session('msg') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                @foreach ($products as $product)
                    <form action="{{ route('selects', $product->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="col-sm-5 col-md-5">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h3>{{ $product->name }}</h3>
                                    <p>{{ $product->description }}</p>
                                    <p>Buy for ${{ substr_replace($product->price, '.', 2, 0) }}</p>
                                    <button>Pay with stripe</button>
                                    <a href="{{ route('select1', $product->id) }}">Pay with wechat</a>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>

        </div>
    </div>

@endsection