@extends('layouts.inicio')
@section('informacion')
<main class="IoT">
    <br>
    <br>
    <br>

    <script type="module" src="{{ asset('js/firestore.js') }}"></script>
    <div class="contenedor">
        <h1 class="titulo">Creciente de agua</h1>
        <p id="distancia" class="info">Distancia: 0CM</p>
        <p id="tiempo" class="info">Tiempo: 00:00 M</p>
        <input type="checkbox" id="riego" name="riego" checked onchange="actualiza()">
        <label for="riego">Verificador</label>
    </div>

    <div>
        <p></p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    {{-- <div class="parallax" id="bosque">
        <h2 class="txt-encima">BOSQUE</h2>
    </div>

    <div class="parallax" id="cascada">
        <h2 class="txt-encima">CASCADA</h2>
    </div> --}}
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</main>

@endsection
