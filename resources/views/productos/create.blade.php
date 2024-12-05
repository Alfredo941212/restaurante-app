@extends('layouts.inicio')
@section('informacion')
<div class="seccion-catalogo">
    <br><br><br><br>
    <div class="row">
        <div class="col-2">
            <a href="{{route('cata.index')}}" class="btn btn-info">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        <div class="col-3"><h1>Nueva orden</h1></div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('cata.store')}}" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="mb-3">
                    <label for="nombre_producto" class="form-label">Orden</label>
                    <input value="{{ old('nombre_producto') }}" type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" required>
                    <div id="nombreHelp" class="form-text">Nombre de la orden.</div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-warning">Limpiar</button>
            </div>
        </div>
    </form>
</div>
@endsection