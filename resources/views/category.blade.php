@extends('layouts.app')

@section('styles')
    <link href="css/category.css" rel="stylesheet" />
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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


    <!-- show all categories info -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-8 p-1">
            @foreach($categories as $category)
                <div class="row justify-content-center category-item">
                    <div class="col-9">
                        <h4>{{ $category->name }}</h4>
                        <div class="col-9 offset-1">
                            <p>{{ $category->description }}</p>
                        </div>
                    </div>

                    <div class="col-2 text-center pt-3">
                        <button class="btn btn-info editCategoryBtn" id="{{ $category->id }}">Edit</button>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>

    <!-- edit categories form -->
    <div class="EditCateForm">

        <form action="/category" method="post" class="col-9 col-md-6 col-lg-5 cateForm">
            @csrf
            <div class="col text-right">
                <button type="button" class="btn btn-danger CloseFormBtn"><i class="fas fa-times fa-1x"></i></button>
            </div>

            <div class="col">
                <label for="E_Name_C">Name :</label>
                <input type="text" name="E_Name_C" id="E_Name_C" class="form-control @error('E_Name_C') is-invalid  @enderror">
            </div>

            <div class="col">
                <label for="E_Desc_C">Description :</label>
                <textarea name="E_Desc_C" id="E_Desc_C" cols="30" rows="10" class="form-control @error('E_Desc_C') is-invalid  @enderror"></textarea>
            </div>

            <div class="col">
                <label for="countP">Count Products :</label>
                <h3 id="countP">0</h3>
            </div>

            <input type="hidden" name="idCate" id="idCate">

            <div class="col text-center">
                <button type="submit" class="btn btn-success">edit <i class="fas fa-edit"></i></button> <!-- submit for edit product -->
            </div>

        </form>
    </div>
@endsection


@section('scripts')
    <script src="js/category.js"></script>
@endsection
