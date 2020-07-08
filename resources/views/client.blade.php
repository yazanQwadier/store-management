@extends('layouts.app')

@section('styles')
    <link href="css/client.css" rel="stylesheet" />
@endsection


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
    <form action="/addClient" method="post" class="formAddclient">
        @csrf
        <div class="row justify-content-center">
            <div class="col-11 col-md-6 col-lg-3">
                <label for="clientName">Client :</label>
                <input list="clients" name="clientName" id="clientName" value="{{ Request::old('clientName') }}" class="form-control @error('clientName') is-invalid @enderror">

                <datalist id="clients">
                    @foreach($clients as $client)
                        <option value="{{ $client->name }}">{{ $client->name }}</option>
                    @endforeach
                </datalist>
            </div>

            <div class="col-11 col-md-6 col-lg-3">
                <label for="phoneC">Phone :</label>
                <input type="text" name="phoneC"class="form-control" id="phoneC">
            </div>

            <div class="col-11 col-md-6 col-lg-3">
                <label for="sectionC">Section :</label>
                <input type="text" name="sectionC" class="form-control" id="sectionC">
            </div>

            <div class="col-2">
                <input type="submit" value="add" class="btn btn-success btnAddClient">
            </div>
        </div>
    </form>
    <hr>

    <!-- show all clients info -->
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-user"></i> Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Section</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->section }}</td>
                <td> <button class="editClientBtn btn btn-info" id="{{ $client->id }}">edit</button> </td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>

    <!-- edit or delete client form -->
    <div class="EditClientForm" >

        <form action="/client" method="post" class="col-9 col-md-6 col-lg-5 clientForm">
            @csrf

            <div class="col text-right">
                <button type="button" class="btn btn-danger CloseFormBtn"><i class="fas fa-times fa-1x"></i></button>
            </div>

            <div class="col">
                <label for="E_Name_C">Name :</label>
                <input type="text" name="E_Name_C" id="E_Name_C" class="form-control @error('E_Name_C') is-invalid  @enderror">
            </div>

            <div class="col">
                <label for="E_Phone_C">Phone :</label>
                <input type="text" name="E_Phone_C" id="E_Phone_C" class="form-control @error('E_Phone_C') is-invalid  @enderror">
            </div>

            <div class="col">
                <label for="E_Section_C">Phone :</label>
                <input type="text" name="E_Section_C" id="E_Section_C" class="form-control @error('E_Section_C') is-invalid  @enderror">
            </div>

            <input type="hidden" name="idClient" id="idClient">

            <div class="col text-center py-2 m-1">
                <button type="button" class="btn btn-danger" onclick="confirmDel()">delete <i class="fas fa-trash-alt"></i></button>  <!-- submit for delete client -->
                <button type="submit" class="btn btn-info" id="editSubmit" >edit <i class="fas fa-edit"></i></button> <!-- submit for edit client -->
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    <script src="js/client.js"></script>
@endsection
