<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;

class Personas extends Controller
{
   public function mostrarDatos(){
 
        $datos = DB::table('personas')
                    ->join('users', 'personas.id', '=', 'users.persona_id')
                    ->join('roles', 'users.rol_id', '=', 'roles.id')
                    ->select('personas.*', 'users.name', 'roles.rol')
                    ->where('personas.estado',true)
                    ->get();

         return response()->json(['datos'=>$datos]);           
   }

   public function delete($idpersona){
      $persona= Persona::find($idpersona);
      if($persona->estado==false){
         return response()->json(['message'=>"El Registro ya ha sido eliminado anterioemente"]);          
      }
      $persona->estado=false;
      $persona->save();
      return response()->json(['message'=>"Registro eliminado"]);          
   }

   public function update(Request $request, $idpersona){
      
      if(empty($request->nombre) || empty($request->cedula) ||empty($request->direccion)||empty($request->fecha_nacimiento)){
         return response()->json(['message'=>"No se permiten campos vacios"]);   
      }

      if(empty($idpersona)){

         return response()->json(['message'=>"El id no puede estar vacio"]);          
      }
      $persona= Persona::find($idpersona);
      if($persona->estado==false){
         return response()->json(['message'=>"El Registro ya ha sido eliminado anterioemente"]);          
      }
      
      $persona->nombre=$request->nombre;
      $persona->direccion=$request->direccion;
      $persona->cedula=$request->cedula;
      $persona->fecha_nacimiento=$request->fecha_nacimiento;

      $persona->save();
      return response()->json(['message'=>"Registro update"]);          
   }



}
