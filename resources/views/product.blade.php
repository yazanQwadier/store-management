@extends('layouts.app')


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
    @foreach($products as $product)
        <div style="border:1px solid #ccc;">
            <h4>Name : {{ $product->name }}</h4>
            <p>Price : {{ $product->price }}</p>
            <p>Quantity : {{ $product->quantity }}</p>
            <p>Category : {{ \App\Http\Controllers\productController::getNameCategory($product->cate_id ) }}</p>
            <button class="editProductBtn" id="{{ $product->id }}">Edit</button>
        </div>
    @endforeach

    <!-- edit or delete product form -->
    <div class="EditProdForm" style="display:none;">
        <button class="CloseFormBtn">X</button>

        <form action="/product" method="post">
            @csrf
            <div>
                <label for="E_Name_P">Name :</label>
                <input type="text" name="E_Name_P" id="E_Name_P" class="@error('E_Name_P') is-invalid  @enderror">
            </div>

            <div>
                <label for="E_Price_P">Description :</label>
                <input type="number" name="E_Price_P" id="E_Price_P" class="@error('E_Price_P') is-invalid  @enderror">
            </div>

            <div>
                <label for="E_Quan_P">Description :</label>
                <input type="number" name="E_Quan_P" id="E_Quan_P" class="@error('E_Quan_P') is-invalid  @enderror">
            </div>

            <div>
                <label for="E_cate_P">Category :</label>
                <input list="categories_P" name="E_cate_P" id="E_cate_P" class="@error('E_cate_P') is-invalid  @enderror">

                <datalist id="categories_P"> </datalist>
            </div>

            <input type="hidden" name="idProd" id="idProd">

            <input type="submit" value="edit"> <!-- submit for edit product -->
            <input type="submit" formaction="REMproduct" value="delete">  <!-- submit for delete product -->
        </form>
    </div>
@endsection


@section('scripts')
    <script src="js/product.js"></script>
@endsection
