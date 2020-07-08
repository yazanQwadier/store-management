@extends('layouts.app')

@section('styles')
    <link href="css/createAction.css" rel="stylesheet" />
@endsection


@section('content')

    <!-- show the result on every action on each product (1 .. 3) -->
    @if ( session('result') )
        @for( $i=0; $i < count( json_decode( session('result') ) ); $i++)
            <div class="alert alert-{{ json_decode( session('result') )[$i]->title }}" >
                {{ json_decode( session('result') )[$i]->message }}
            </div>
        @endfor
    @endif

    <div class="container">
        <div class="row">

         <!-- form for import/export products (1 or 2 or 3 products) -->
         <form action="/createAction" method="post" id="formLaout" class="col-11 col-md-9 col-lg-7">
            @csrf

            <!-- (type action section) in a form -->
            <div class="col-6 offset-3">
                <select name="typeA" class="form-control" id="typeA">
                    <option value="import">Import</option>
                    <option value="export">Export</option>
                </select>
            </div>
            <hr>

            @for($i=1; $i <= 3; $i++)
            <div class="formP formP{{ $i }}" style="@if($i > 1) display:none; @endif">
                <div class="col text-right">
                    <button type="button" class="btn btn-danger" id="closeForm"><i class="fas fa-times"></i></button>
                </div>

                <div>
                    @if( $errors->any() )
                        <div class="alert alert-danger"> {{ $errors->first() }} </div>
                    @endif
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="nameP{{ $i }}">Product Name :</label>
                        <input type="text" name="nameP{{ $i }}" id="nameP{{ $i }}" value="{{ Request::old( 'nameP $i ' ) }}" class="form-control @error('nameP{{ $i }}') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label for="categP{{ $i }}">Category :</label>
                        <input list="categP{{ $i }}" name="categP{{ $i }}" id="categP{{ $i }}" value="{{ Request::old('categP $i ') }}" class="form-control @error('categP{{ $i }}') is-invalid @enderror">

                        <datalist id="categP{{ $i }}">
                            @foreach($categories as $c)
                                <option value="{{ $c->name }}">{{ $c->name }}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="priceP{{ $i }}">Price Product :</label>
                        <input type="number" step=0.1 min=0.1 name="priceP{{ $i }}" id="priceP $i " value="{{ Request::old('priceP $i ') }}" class="form-control @error('priceP{{ $i }}') is-invalid @enderror">
                    </div>

                    <div class="col">
                        <label for="quantP{{ $i }}">Quantity Product :</label>
                        <input type="number" step=0.1 min=0.1 name="quantP{{ $i }}" id="quantP{{ $i }}" value="{{ Request::old('quantP $i ') }}" class="form-control @error('quantP{{ $i }}') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-6">
                        <label for="dateA{{ $i }}">Action Date :</label>
                        <input type="date" name="dateA{{ $i }}" id="dateA{{ $i }}" value="{{ Request::old('dateA $i ') }}" class="form-control @error('dateA{{ $i }}') is-invalid @enderror">
                    </div>
                </div>
            </div>
            @endfor

            <hr>

            <!-- (client info section) in a form -->
            <div class="clientSection">
                <div class="form-row">
                    <div class="col">
                        <label for="clientName">Client :</label>
                        <input list="clients" name="clientName" id="clientName" value="{{ Request::old('clientName') }}" class="form-control @error('clientName') is-invalid @enderror">

                        <datalist id="clients">
                            @foreach($clients as $client)
                                <option value="{{ $client->name }}">{{ $client->name }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col">
                        <label for="phoneC">Phone :</label>
                        <input type="text" name="phoneC" class="form-control" id="phoneC">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-6">
                        <label for="sectionC">Section :</label>
                        <input type="text" name="sectionC" class="form-control" id="sectionC">
                    </div>
                </div>
            </div>
            <hr>

            <div class="col text-center">
                <input type="submit" value="save" class="btn btn-success" id="saveAddP">
            </div>

            <input type="hidden" name="countForms" id="countForms" value="1">
        </form>



    </div>
    <div class="col text-center">
            <button id="toggleForm" data-forms="1" class="btn btn-info" type="button" title="add new product"> <i class="fas fa-plus"></i> </button>
        </div>
    </div>
@endsection
