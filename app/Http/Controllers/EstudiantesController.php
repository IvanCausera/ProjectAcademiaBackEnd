<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $respuesta = Estudiante::create($inputs);
        return $respuesta;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            return $e;
        } else {
            return response()->jason([
                'error'=>true,
                'mensaje'=>'No existe el estudiante.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){  
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            if($e->save()){
                return $e;
            }
        } else {
            return response()->jason([
                'error'=>true,
                'mensaje'=>'No existe el estudiante.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){  
            $respuesta = Estudiante::destroy($id);
            if($respuesta){
                return $e;
            } else {
                return response()->jason([
                    'error'=>true,
                    'mensaje'=>'Error en la eliminacion del estudiante.'
                ]);
            }
        } else {
            return response()->jason([
                'error'=>true,
                'mensaje'=>'No existe el estudiante.'
            ]);
        }
    }
}
