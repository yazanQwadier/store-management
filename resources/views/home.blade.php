@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( Auth::check() )
                        <div>
                            <h2>
                                {{ Auth::user()->name }}
                            </h2>

                            <p>
                                {{ Auth::user()->description }}
                            </p>

                            <div>
                                <button id="btn-import" onclick="goTo('createAction')" >Import/Export Product</button>
                                <button id="btn-edit-category" onclick="goTo('category')">Edit Category Info</button>
                                <button id="btn-edit-product" onclick="goTo('product')">Edit Product Info</button>
                                <button id="btn-edit-client" onclick="goTo('client')">Edit Client Info</button>
                                <button id="btn-edit-action" onclick="goTo('action')">Actions History</button>
                            </div>

                            <hr>

                            <div>
                                <h3>Clients : {{ count($clients) }}</h3>

                                <h3>Categories : {{ count($categories) }}</h3>

                                <h3> Products : {{ count($products) }}</h3>

                                <h3> Actions : {{ count($actions) }}</h3>
                            </div>
                        </div>
                    @else
                        <div>
                            <p>No Authenticated Account !</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
