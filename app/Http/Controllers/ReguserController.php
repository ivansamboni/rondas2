<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ReguserController extends Controller
{
    public function userlist(){
        $usuarios =  User::orderby('name', 'asc')->get();
          return response()->json($usuarios);
      }
  
        
      protected function newuser(Request $request)
      {
  
          $request->validate([
  
              'name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],              
              'rol' => ['required', 'string', 'max:255']
          ]);
          $usuarios = User::create([
              'name' => $request['name'],
              'email' => $request['email'],
              'rol' => $request['rol'],
              'password' => Hash::make($request['password']),
          ]);     
          return response()->json(['usuarios' => $usuarios]);
      }
  
      public function deleteuser(Request $request){        
          $id = $request->id;       
          User::destroy($id);                
      }

      public function showuser(Request $request){  

        $id = $request->id;       
        $usuario = User::find($id);  
        
        return response()->json($usuario);
    }

    public function updateuser(Request $request){  
              
        $request->validate([
  
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'rol' => ['required', 'string', 'max:255']
        ]);
        $id = $request->id;       
        $usuario = User::find($id);  
        $usuario->name = $request['name'];
        $usuario->email = $request['email'];
        $usuario->rol = $request['rol'];       
        $usuario->save();
        
        return response()->json($usuario);
    }
}
