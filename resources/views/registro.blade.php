@extends("layouts.plantilla")

@section("title", "ZIO - Registro")
@section("styles", "css/estilos.css")
<link rel="stylesheet" href="{{route('index')}}/css/registro.css">

@section('content')

<header>
    <nav class="navbar navbar-light bg-light justify-content-center align-items-center">
        <div class="logo">
          <a class="navbar-brand d-flex align-items-center gap-2" href="../">
            <img src="{{route('index')}}/img/logo_ZIO.svg" alt="Logo ZIO" width="35" height="35" class="d-inline-block">
            <span>ZIO</span>
          </a>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <div class="row portada">
        <div class="col-12 col-md-8 text-center d-flex align-items-center justify-content-center">
            <h2> Registrate en ZIO para tener acceso a la galería de imagenes más liviana y rápida. </h2>
            <form action="{{route('registrarUsuario')}}" method="POST">
                @csrf
                <label for="nombre"> Nombre: </label>
                @error('nombre')
                    <div class="error msg-error mb-1">*{{$message}}</div>
                @enderror
                <input type="text" name="nombre" id="nombre" value="{{old('nombre')}}">

                <label for="email"> Email: </label>
                @error('email')
                    <div class="error msg-error mb-1">*{{$message}}</div>
                @enderror
                <input type="email" name="email" id="email" value="{{old('email')}}">

                <label for="pswd"> Contraseña: </label>
                @error('pswd')
                    <div class="error msg-error mb-1">*{{$message}}</div>
                @enderror
                <input type="password" name="pswd" id="pswd" value="{{old('pswd')}}">

                <div>
                @php
                if (isset($_SESSION["registroCompleto"])) {
                    if ($_SESSION["registroCompleto"] != "") {
                        echo $_SESSION["registroCompleto"];
                        $_SESSION["registroCompleto"] = "";
                    }
                }
                @endphp
                </div>

                <div class="d-flex justify-content-center">
                    <input type="submit" class="boton_sesion" value="Registrarse">
                </div>
            </form>
        </div>
    </div>
</main>

<div class="d-flex imagenes_fondo">
    <img src="{{route('index')}}/img/dreamer.svg" class="col-4 img-fluid">
    <img src="{{route('index')}}/img/photo_session.svg" class="col-4 img-fluid">
</div>
@endsection