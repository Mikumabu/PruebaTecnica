<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
        @if(auth()->user()->tipo_usuario != "1")
            <script>window.location = "/";</script>
        @endif
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                @auth
                    @if(auth()->user()->tipo_usuario == "1")
                        <a class="nav-link" href="{{ route('admin') }}">Admin</a>
                        <a class="nav-link" href="{{ route('user') }}">Usuarios</a>
                        <a class="nav-link" href="{{ route('docs') }}">Documentos</a>
                    @endif
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endauth
              </div>
            </div>
          </nav>
        <form method="POST" id="form-id" action="{{ route('ingresarDocumento') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Seleccionar Usuario</label>
                <div>
                    <select id="nombre" name="nombre" class="nombre">
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="docto">Documento</label>
                <input type="file" class="form-control" id="docto" name="docto" placeholder="Seleccionar archivo" accept=".doc, .docx, .pdf, xlsx">
            </div>
            <button type="submit" class="btn btn-primary">
                Subir Documento
            </button>
        </form>
    </body>
</html>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           url:'GetNombre',
           method:'GET',
            success:function(data){
                $('.nombre').html(data);
            }
        });
    });
</script>