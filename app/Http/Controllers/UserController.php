<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs['password'] = Hash::make(trim($request->password));
        $respuesta = User::create($inputs);
        return $respuesta;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            return $user;
        } else {
            return response()->jason([
                'error'=>true,
                'mensaje'=>'No existe.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if(isset($user)){  
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if($user->save()){
                return $user;
            }
        } else {
            return response()->jason([
                'error'=>true,
                'mensaje'=>'No existe.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(isset($user)){  
            $respuesta = User::destroy($id);
            if($respuesta){
                return $user;
            } else {
                return response()->jason([
                    'error'=>true,
                    'mensaje'=>'Error en la eliminacion.'
                ]);
            }
        } else {
            return response()->jason([
                'error'=>true,
                'mensaje'=>'No existe.'
            ]);
        }
    }
}
