@extends('layouts.app')


@section('content')

    <!-- show all clients info -->
    @foreach($actions as $action)
        <div style="border:1px solid #ccc;">
            type :<h4>{{ $action->type }}</h4>
            client name :<p>{{ $action->client_name }}</p>
            product name : <p>{{ $action->product_name }}</p>
            price : <p>{{ $action->price }}</p>
            quantity : <p>{{ $action->quantity }}</p>
            date : <p>{{ $action->date }}</p>
            notes : <p>{{ $action->notes }}</p>
        </div>
    @endforeach

@endsection
