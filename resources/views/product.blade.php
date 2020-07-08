@extends('layouts.app')

@section('styles')
    <link href="css/product.css" rel="stylesheet" />
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

    <!-- show all products -->
    <div class="container">
        <div class="row justify-content-center">
        @foreach($products as $product)
            <div class="col-11 col-md-5 col-lg-3 product-item">
                <div class="row">
                    <div class="col-5 h5">Name : </div>
                    <div class="col h5">{{ $product->name }}</div>
                </div>
                <div class="row">
                    <div class="col-5">Price : </div>
                    <div class="col">{{ $product->price }}</div>
                </div>
                <div class="row">
                    <div class="col-5">Quantity : </div>
                    <div class="col">{{ $product->quantity }}</div>
                </div>
                <div class="row">
                    <div class="col-5">Category : </div>
                    <div class="col">{{ \App\Http\Controllers\productController::getNameCategory($product->cate_id ) }}</div>
                </div>
                <hr>
                <div class="col text-center">
                    <button class="btn btn-info editProductBtn" id="{{ $product->id }}">Edit</button>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <!-- edit or delete product form -->
    <div class="EditProdForm" style="display:none;">

        <form action="/product" method="post" class="col-9 col-md-6 col-lg-5 prodForm">
            @csrf
            <div class="col text-right">
                <button type="button" class="btn btn-danger CloseFormBtn"><i class="fas fa-times fa-1x"></i></button>
            </div>

            <div class="col">
                <label for="E_Name_P">Name :</label>
                <input type="text" name="E_Name_P" id="E_Name_P" class="form-control @error('E_Name_P') is-invalid  @enderror">
            </div>

            <div class="col">
                <label for="E_Price_P">Description :</label>
                <input type="number" name="E_Price_P" id="E_Price_P" class="form-control @error('E_Price_P') is-invalid  @enderror">
            </div>

            <div class="col">
                <label for="E_Quan_P">Description :</label>
                <input type="number" name="E_Quan_P" id="E_Quan_P" class="form-control @error('E_Quan_P') is-invalid  @enderror">
            </div>

            <div class="col">
                <label for="E_cate_P">Category :</label>
                <input list="categories_P" name="E_cate_P" id="E_cate_P" class="form-control @error('E_cate_P') is-invalid  @enderror">
                <datalist id="categories_P"> </datalist>
            </div>

            <input type="hidden" name="idProd" id="idProd">

            <div class="col text-center">
                <button type="button" class="btn btn-danger"onclick="confirmDel()">delete <i class='fas fa-trash-alt'></i> </button> <!-- submit for delete product -->
                <button type="submit" class="btn btn-info" id="editSubmit" >edit <i class="fas fa-edit"></i></button> <!-- submit for edit product -->
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    <script src="js/product.js"></script>
@endsection
