@extends('layouts.inicio')
@section('informacion')
    <div class="seccion-catalogo">
    <br><br><br><br>

        <div class="row">
            <h1>Menú</h1>
            <div class="col-2">
                <a href="{{route('cata.create')}}" class="btn btn-info boton-mas"><i class="fa-solid fa-circle-plus"></i></a>
            </div>
            
        </div>


        <div class="row justify-content-center">
            <div class="col-3">
                <h3 class="titulo-catalogo">Nombre</h3>
            </div>
            <div class="col-3">
                <h3 class="titulo-catalogo"> Acciones</h3>
            </div>
        </div>

        @foreach ($lista as $cat)
            <div class="row justify-content-center">
                <div class="col-4">
                    <p class="txt-catalogo">{{ $cat->nombre_producto }}</p>
                </div>
                <div class="col-3 contenedor-acciones">
                    <a href="" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>

                </div>
            </div>
        @endforeach
    </div>
@endsection
