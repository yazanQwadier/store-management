@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('title'))
        <div class="alert alert-{{ session('title') }}">{{ session('message') }}</div>
    @endif

    <!-- Errors when save something -->
    @if( $errors->any() )
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- add new client form -->
    <form action="addClient" method="post">
        @csrf
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

        <input type="submit" value="add">
    </form>

    <!-- show all clients info -->
    @foreach($clients as $client)
        <div style="border:1px solid #ccc;">
            Name :<h4>{{ $client->name }}</h4>
            Phone :<p>{{ $client->phone }}</p>
            Section : <p>{{ $client->section }}</p>
            <button class="editClientBtn" id="{{ $client->id }}">Edit</button>
        </div>
    @endforeach

    <!-- edit or delete client form -->
    <div class="EditClientForm" style="display:none;">
        <button class="CloseFormBtn">X</button>
        <form action="/client" method="post">
            @csrf
            <div>
                <label for="E_Name_C">Name :</label>
                <input type="text" name="E_Name_C" id="E_Name_C" class="@error('E_Name_C') is-invalid  @enderror">
            </div>

            <div>
                <label for="E_Phone_C">Phone :</label>
                <input type="text" name="E_Phone_C" id="E_Phone_C" class="@error('E_Phone_C') is-invalid  @enderror">
            </div>

            <div>
                <label for="E_Section_C">Phone :</label>
                <input type="text" name="E_Section_C" id="E_Section_C" class="@error('E_Section_C') is-invalid  @enderror">
            </div>

            <input type="hidden" name="idClient" id="idClient">

            <input type="submit" value="edit">
            <input type="submit" formaction="REMclient" value="delete">
        </form>
    </div>
@endsection


@section('scripts')
    <script src="js/client.js"></script>
@endsection
