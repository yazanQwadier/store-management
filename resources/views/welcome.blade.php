<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Store Management</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


         <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fefefe;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .back{
                background-image: url('backImg.svg');
                background-repeat: no-repeat;
                background-size: contain;
                background-position:center;
                height:100vh;
            }

            .title {
                margin-top:14vh;
                color:#515151;
                font-size:43px;
            }

            .brief{
                margin-top:2vh;
                font-size:28px;
                text-shadow:1px 1px 1px #ccc;
            }

            .links{
            }

            .links > a {
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                margin: 3px;
                display: inline-block;
                color: white;
            }

            .links .login-link{
                background-color: #f66;
                padding: 11px 17px;
            }

            .links .reg-link{
                background-color: #646464;
                padding: 9px 17px;
            }

            .links a:hover{
                color: #6c63ff;
            }
        </style>
    </head>
    <body>

        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-md-6 back">
                    <div class="row">

                        <div class="col-xs col-md-8 d-block d-md-none text-center">
                            @if (Route::has('login'))
                                <div class="text-center links">
                                    @auth
                                        <a href="{{ url('/home') }}">Home</a>
                                    @else
                                        <a class="login-link" href="{{ route('login') }}">Login</a>

                                        @if (Route::has('register'))
                                            <a class="reg-link" href="{{ route('register') }}">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                    <div class="row">
                        <div class="col text-center h1 title">
                            Store Management
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8 offset-2 text-center h5 brief">
                            Create your own warehouse, add your products, and keep your business record. <br>Free
                        </div>
                    </div>

                    <div class="row d-none d-md-block">
                        <div class="col text-center">
                            @if (Route::has('login'))
                                <div class="text-center links">
                                    @auth
                                        <a href="{{ url('/home') }}">Home</a>
                                    @else
                                        <a class="login-link" href="{{ route('login') }}">Login</a>

                                        @if (Route::has('register'))
                                            <a class="reg-link" href="{{ route('register') }}">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>
