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

    <!-- show all categories info -->
    @foreach($categories as $category)
        <div style="border:1px solid #ccc;">
            <h4>{{ $category->name }}</h4>
            <p>{{ $category->description }}</p>
            <button class="editCategoryBtn" id="{{ $category->id }}">Edit</button>
        </div>
    @endforeach

    <!-- edit categories form -->
    <div class="EditCateForm" style="display:none;">
        <button class="CloseFormBtn">X</button>
        <form action="/category" method="post">
            @csrf
            <div>
                <label for="E_Name_C">Name :</label>
                <input type="text" name="E_Name_C" id="E_Name_C" class="@error('E_Name_C') is-invalid  @enderror">
            </div>

            <div>
                <label for="E_Desc_C">Description :</label>
                <input type="text" name="E_Desc_C" id="E_Desc_C" class="@error('E_Desc_C') is-invalid  @enderror">
            </div>

            <div>
                <label for="countP">Count Products :</label>
                <h3 id="countP"></h3>
            </div>

            <input type="hidden" name="idCate" id="idCate">

            <input type="submit" value="edit">
        </form>
    </div>
@endsection


@section('scripts')
    <script src="js/category.js"></script>
@endsection
