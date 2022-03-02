@extends("layouts.plantilla")

@section("title", "ZIO")
@section("styles", "css/estilos.css")

@section('content')
<header>
    <nav class="navbar navbar-light bg-light justify-content-space-between">
        <div class="logo">
          <a class="navbar-brand d-flex align-items-center gap-2" href="">
            <img src="{{route('index')}}/img/logo_ZIO.svg" alt="Logo ZIO" width="35" height="35" class="d-inline-block">
            <span>ZIO</span>
          </a>
        </div>
        <div class="boton_registro">
            <a href="{{route('registro')}}">Registrarse</a>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <div class="row portada">
        <div class="col-12 col-md-8 text-center d-flex align-items-center justify-content-center">
            <h2> ZIO, la plataforma más liviana de imagenes </h2>
            <form action="{{route('iniciarSesion')}}" method="POST">
                <div class="d-flex justify-content-center align-items-center gap-0">
                    <h4> ¿Tienes ya una cuenta en ZIO?</h4>
                    <h4> Inicia sesión aquí </h4>
                </div>
                @csrf
                <label for="email"> Email: </label>
                @error('email')
                    <div class="msg-error mb-1">*{{$message}}</div>
                @enderror
                <input type="email" name="email" id="email" value="{{old('email')}}">

                <label for="pswd"> Contraseña: </label>
                @error('pswd')
                    <div class="msg-error mb-1">*{{$message}}</div>
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
                    if (isset($_SESSION["error"])) {
                        if ($_SESSION["error"] != "") {
                            echo $_SESSION["error"];
                            $_SESSION["error"] = "";
                        }
                    }
                    @endphp
                </div>
                <div class="d-flex justify-content-center">
                    <input type="submit" class="boton_sesion" value="Iniciar sesión">
                </div>
            </form>
        </div>
        <div class="col-12 col-md-4">
            <img class="img-fluid imagen_portada" alt="Chica mirando un cuadro" src="{{route('index')}}/img/art_lover.svg">
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container text-center">
        <span class="text-muted">Jesús Sánchez Rodríguez y José Antonio Sánchez Andrades &copy; 2022</span>
    </div>
</footer>
@endsection