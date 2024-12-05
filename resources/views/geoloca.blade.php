@extends('layouts.inicio')
@section('informacion')
<form action="" method="GET" class="d-flex justify-content-center m-4" >
    <select id="destino" name="destino" class="form-select" >
        <option value="" selected>Seleccione un destino</option>
        <option value="16.753864,-93.115473" {{ (isset($_GET['destino']) && $_GET['destino'] == '16.753864,-93.115473') ? 'selected' : '' }}>Tuxtla</option>
        <option value="17.526592,-92.004158" {{ (isset($_GET['destino']) && $_GET['destino'] == '17.526592,-92.004158') ? 'selected' : '' }}>Palenque</option>
        <option value="16.9052261,-92.1124486" {{ (isset($_GET['destino']) && $_GET['destino'] == '16.9052261,-92.1124486') ? 'selected' : '' }}>Ocosingo</option>
    </select>
    
    <select id="modos" name="modos" class="form-select" >
        <option value="" >Seleccione el modo</option>
        <option value="driving" {{ (isset($_GET['modos']) && $_GET['modos'] == 'driving') ? 'selected' : '' }}>En auto</option>
        <option value="walking" {{ (isset($_GET['modos']) && $_GET['modos'] == 'walking') ? 'selected' : '' }}>A pie</option>
        <option value="bicycling" {{ (isset($_GET['modos']) && $_GET['modos'] == 'bicycling') ? 'selected' : '' }}>En bicicleta</option>
    </select>
    
    <button class="btn btn-primary" type="submit" value="buscar" id="buscar" name="buscar">Buscar</button>
</form>

<?php
$medio = isset($_GET['modos']) ? $_GET['modos'] : 'driving';
$llegada = isset($_GET['destino']) && $_GET['destino'] !== '' ? $_GET['destino'] : '16.753864,-93.115473';  // Default to Tuxtla
$avoid = ($medio == 'driving') ? '&avoid=tolls|highways' : '';
$key = env('GOOGLE_MAPS_API_KEY');

try {
    $respuesta = file_get_contents("https://maps.googleapis.com/maps/api/directions/json?key={$key}&origin=16.7378774,-92.641203&destination={$llegada}&mode={$medio}");
    $json = json_decode($respuesta);

    if (isset($json->routes[0])) {
        $distancia = $json->routes[0]->legs[0]->distance->text;
        $duracion = $json->routes[0]->legs[0]->duration->text;
        $resumen = $json->routes[0]->summary;
        echo '<br><center><b>' . $resumen . '</b><br><b>Distancia:</b> ' . $distancia . '<b> Duración:</b> ' . $duracion . '</center>';
    } else {
        echo '<center><b>No se pudo obtener la ruta. Verifique los datos ingresados.</b></center>';
    }
} catch (Exception $e) {
    echo '<center><b>Error al procesar la solicitud. Por favor, intente más tarde.</b></center>';
}
?>

<iframe width="1500" height="600" style="border:3px" loading="lazy" allowfullscreen
src="https://www.google.com/maps/embed/v1/directions?key={{$key}}&origin=16.737647,-92.638425&destination={{$llegada}}{{$avoid}}"></iframe>
@endsection
