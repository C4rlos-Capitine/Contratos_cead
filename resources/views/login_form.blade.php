<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="cead.png" type="image/x-icon">
    <link rel="stylesheet" href="body-style.css">
    <link href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{asset('fontawsome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontawsome/css/fontawesome.min.css')}}" rel="stylesheet">
    <link href="{{asset ('bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('dataTables.bootstrap5.min.css')}}" rel="stylesheet">
    <script src="{{asset('jquery-3.7.0.js')}}"></script>
    <script src="{{asset('dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('jquery.dataTables.min.js')}}"></script>
    <link href="{{asset('tailwind.min.css')}}" rel="stylesheet">
    <link href="{{asset('popup.css')}}" rel="stylesheet">
    <link href="{{asset('tailwind.min.css')}}" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card-form {
            max-width: 700px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Make form inputs responsive */
        .form-floating {
            margin-bottom: 20px;
        }

        /* Add more responsive CSS as needed */

        /* Center the button */
        .btn-primary {
            display: block;
            margin: 0 auto;
        }

        img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .field {
            margin-bottom: 20px;
        }

        .imagem {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body>

<form class="card-form" action="{{ url('login') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="field">
                <label>Sistema de Gestão de Contratos de Tutoria do CEAD</label>
            </div>
            @if ($errors->any())
                <div class="bg-red-200 p-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="email" autocomplete="off" placeholder="nome do user">
                <label for="floatingInput">Email do utilizador</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="password" name="password" placeholder="senha">
                <label for="floatingInput">Senha</label>
            </div>
            <div class="field">
                <label for="remember">
                    <input type="checkbox" name="remember" id="remember">guardar a sessão
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="imagem">
                <img src="{{url('cead.png')}}">
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="rounded bg-green-600 text-white px-2 py-1" type="submit">Login</button>
    </div>
</form>
</body>
</html>
