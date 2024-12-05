@extends('layouts.inicio')
@section('informacion')
<div id="formulario" class="row align-items-center justify-content-around">
    <div class="col-lg-4 col-10">
        <h2 id="letrero">Buscador de Usuarios</h2>
        <br><br>
        <form method="get" action="">
            <div class="form-row">
                <div class="col">
                    <label for="hashtag1">Usuario:</label>
                    <input id="hashtag1" type="text" class="form-control" placeholder="Usuario de Twitter" name="hashtag" value="{{ request('hashtag') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ver Tweets</button>
        </form>
    </div>
    <div class="col-lg-6 col-10">
        @php
        function queryTwitter($search) {
            $url = "https://api.x.com/2/users/by/username/" . $search;
            $bearer_token = "AAAAAAAAAAAAAAAAAAAAAOFHwwEAAAAACkcdnAjJIxP2OsYyCmPL3lHKhEo%3DLELzRsSjpnU2ryoPjT6lc7ZtnptLX7Oxey0n2XNlW9CVhbiYCt"; // Sustituir por tu token
            $header = ['Authorization: Bearer ' . $bearer_token];
            $options = [
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_HEADER => false,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false
            ];
            $feed = curl_init();
            curl_setopt_array($feed, $options);
            $response = curl_exec($feed);
            curl_close($feed);
            return $response;
        }
    
        $tiene_busqueda = isset($_GET['hashtag']);
        if ($tiene_busqueda) {
      
            $respuesta = queryTwitter($_GET['hashtag']);
            echo $respuesta;
            $json = json_decode($respuesta);
        
            if (isset($json->data)) {
                $id = $json->data->id;
                $name = $json->data->name;
                $username = $json->data->username;
            } else {
                $error_message = "No se encontró el usuario o hubo un error con la API.";
            }
        }
        @endphp
        @if($tiene_busqueda && isset($json->data))
   
            <div class="card">
                <div class="card-header">
                    {{ $username }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $id }}</h5>
                    <p class="card-text">{{ $name }}</p>
                </div>
            </div>
        @elseif($tiene_busqueda && isset($error_message))
 
            <p class="alert alert-danger">{{ $error_message }}</p>
        @else
 
            <p id="ruta">Escribe un nombre de usuario a buscar.</p>
        @endif
    </div>
</div>
@endsection
