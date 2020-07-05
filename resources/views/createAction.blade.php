@extends('layouts.app')

@section('content')

    <!-- show the result on every action on each product (1 .. 3) -->
    @if ( session('result') )
        @for( $i=0; $i < count( json_decode( session('result') ) ); $i++)
            <div class="alert alert-{{ json_decode( session('result') )[$i]->title }}" >
                {{ json_decode( session('result') )[$i]->message }}
            </div>
        @endfor
    @endif

    <!-- form for import/export products (1 or 2 or 3 products) -->
    <form action="/createAction" method="post" id="formLaout">
        @csrf

        <!-- (type action section) in a form -->
        <div>
            <select name="typeA" id="typeA">
                <option value="import">Import</option>
                <option value="export">Export</option>
            </select>
        </div>

        @for($i=1; $i <= 3; $i++)
        <div class="formP formP{{ $i }}" style="@if($i > 1) display:none; @endif">
            <div>
                <button type="button" id="closeForm">X</button>
            </div>

            <div>
                @if( $errors->any() )
                    <div class="alert alert-danger"> {{ $errors->first() }} </div>
                @endif
            </div>

            <div>
                <label for="nameP{{ $i }}">Product Name :</label>
                <input type="text" name="nameP{{ $i }}" id="nameP{{ $i }}" value="{{ Request::old( 'nameP $i ' ) }}" class="@error('nameP{{ $i }}') is-invalid @enderror">
            </div>

            <div>
                <label for="categP{{ $i }}">Category :</label>
                <input list="categP{{ $i }}" name="categP{{ $i }}" id="categP{{ $i }}" value="{{ Request::old('categP $i ') }}" class="@error('categP{{ $i }}') is-invalid @enderror">

                <datalist id="categP{{ $i }}">
                    @foreach($categories as $c)
                        <option value="{{ $c->name }}">{{ $c->name }}</option>
                    @endforeach
                </datalist>
            </div>

            <div>
                <label for="priceP{{ $i }}">Price Product :</label>
                <input type="number" step=0.1 min=0.1 name="priceP{{ $i }}" id="priceP $i " value="{{ Request::old('priceP $i ') }}" class="@error('priceP{{ $i }}') is-invalid @enderror">
            </div>

            <div>
                <label for="quantP{{ $i }}">Quantity Product :</label>
                <input type="number" step=0.1 min=0.1 name="quantP{{ $i }}" id="quantP{{ $i }}" value="{{ Request::old('quantP $i ') }}" class="@error('quantP{{ $i }}') is-invalid @enderror">
            </div>

            <div>
                <label for="dateA{{ $i }}">Action Date :</label>
                <input type="date" name="dateA{{ $i }}" id="dateA{{ $i }}" value="{{ Request::old('dateA $i ') }}" class="@error('dateA{{ $i }}') is-invalid @enderror">
            </div>
            <hr>
        </div>
        @endfor

        <!-- (client info section) in a form -->
        <div>
            <label for="clientName">Client :</label>
            <input list="clients" name="clientName" id="clientName" value="{{ Request::old('clientName') }}" class="@error('clientName') is-invalid @enderror">

            <datalist id="clients">
                @foreach($clients as $client)
                    <option value="{{ $client->name }}">{{ $client->name }}</option>
                @endforeach
            </datalist>

            <label for="phoneC">Phone :</label>
            <input type="text" name="phoneC" id="phoneC">

            <label for="sectionC">Section :</label>
            <input type="text" name="sectionC" id="sectionC">
        </div>

        <input type="submit" value="save" id="saveAddP">
        <input type="hidden" name="countForms" id="countForms" value="1">
    </form>

    <button id="toggleForm" data-forms="1" type="button">+</button>
@endsection
