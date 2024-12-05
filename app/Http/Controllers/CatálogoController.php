<?php

namespace App\Http\Controllers;
use App\Models\Catálogo;
use Illuminate\Http\Request;

class CatálogoController extends Controller
{
    public function index(){
        $lista = Catálogo::all();
        return view('productos.index')->with(compact('lista'));
    }

    public function create()
    {
        //{}
        return view('productos.create');
    }
    public function store(Request $request)
    {
        //
        //validacion
        $validated = $request->validate(
            [
                'nombre_producto' => 'required|unique:productos|max:255',
            ],
            [
                'nombre_producto.required' => 'Debes pedir una orden.',
                'nombre_producto.unique' => 'El nombre de la categoría ya existe.',
                'nombre_producto.max' => 'El nombre de la categoría no debe exceder 255 caracteres'
            ]
        );
        //agregar
        $cat = new Catálogo;
        $cat->nombre_producto = $request->nombre_producto;
        $cat->save();

        return redirect(route('cata.index'));
    }
}
