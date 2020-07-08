@extends('layouts.app')

@section('styles')
    <link href="css/home.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( Auth::check() )
                        <div class="infoUser">
                            <h2>
                                {{ Auth::user()->name }}
                            </h2>

                            <p class="offset-1 col-md-7 col-11 brief">
                                {{ Auth::user()->description }}
                            </p>

                            <hr>

                            <div class="row justify-content-center btns">
                                <div class="col-6 col-md-3 py-1 text-center">
                                    <button id="btn-import" onclick="goTo('createAction')" >
                                        Import/Export Product <i class="fas fa-store fa-lg"></i>
                                    </button>
                                </div>

                                <div class="col-6 col-md-3 py-1 text-center">
                                    <button id="btn-edit-category" onclick="goTo('category')">
                                    Edit Category Info <i class="fas fa-border-all fa-lg"></i>
                                </button>
                                </div>

                                <div class="col-6 col-md-3 py-1 text-center ">
                                    <button id="btn-edit-product" onclick="goTo('product')">
                                    Edit Product Info <i class="fas fa-dolly fa-lg"></i>
                                </button>
                                </div>

                                <div class="col-6 col-md-3 py-1 text-center">
                                    <button id="btn-edit-client" onclick="goTo('client')">
                                    Edit Client Info <i class="fas fa-users fa-lg"></i>
                                </button>
                                </div>

                                <div class="col-6 col-md-3 py-1 text-center">
                                    <button id="btn-edit-action" onclick="goTo('action')">
                                    Actions History <i class="fas fa-history fa-lg"></i>
                                </button>
                                </div>
                            </div>

                            <hr>

                            <div class="row stats">
                                <div class="col-11 col-md-5 field text-center">
                                    <h4> Clients : </h4 > <h1>{{ count($clients) }}</h1>
                                </div>

                                <div class="col-11 col-md-5 field text-center">
                                    <h4> Categories : </h4 > <h1>{{ count($categories) }}</h1>
                                </div>

                                <div class="col-11 col-md-5 field text-center">
                                    <h4> Products : </h4 > <h1>{{ count($products) }}</h1>
                                </div>

                                <div class="col-11 col-md-5 field text-center">
                                    <h4> Actions : </h4 > <h1>{{ count($actions) }}</h1>
                                </div>
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
