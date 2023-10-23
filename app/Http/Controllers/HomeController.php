<?php

namespace App\Http\Controllers;
use App\Models\Respuesta;
use App\Models\User;



class HomeController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $datares = Respuesta::select('cargo','servicio','estrategia','auditor','fecha')
        ->distinct()
        ->orderBy('fecha', 'desc')->orderBy('fecha', 'desc')->paginate(30);
        return view('home', compact('datares'));
    }

    public function observacionesg()
    {
        $observaciones = Respuesta::select('cargo','servicio','estrategia','observacion','auditor','fecha')->distinct()->where('observacion','NOT LIKE', '')->orderBy('fecha', 'desc')->paginate(30);
        return view('observaciones', compact('observaciones'));
    }
    
}
