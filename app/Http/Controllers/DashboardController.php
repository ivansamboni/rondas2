<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // cumplimiento servicio
    public function cumpliservicio($serv)
    {
        $sc = Respuesta::where('servicio', $serv)->where('respuesta', 'C')->count();
        $snc = Respuesta::where('servicio', $serv)->where('respuesta', 'NC')->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }

        return $totalcumple;
    }
    public function serviciocumple($serv)
    {
        $totalcumple = Respuesta::where('servicio', $serv)->where('respuesta', 'C')->count();

        return $totalcumple;
    }
    public function servicionocumple($serv)
    {
        $totalnocumple = Respuesta::where('servicio', $serv)->where('respuesta', 'NC')->count();

        return $totalnocumple;
    }
    // cumplimiento cargo
    public function cumplicargo($carg)
    {
        $sc = Respuesta::where('cargo', $carg)->where('respuesta', 'C')->count();
        $snc = Respuesta::where('cargo', $carg)->where('respuesta', 'NC')->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }
    public function cargocumple($carg)
    {
        $totalcumple = Respuesta::where('cargo', $carg)->where('respuesta', 'C')->count();

        return $totalcumple;
    }
    public function cargonocumple($carg)
    {
        $totalnocumple = Respuesta::where('cargo', $carg)->where('respuesta', 'NC')->count();

        return $totalnocumple;
    }
    // cumplimiento estrategia
    public function cumpliestrategia($estra)
    {
        $sc = Respuesta::where('estrategia', $estra)->where('respuesta', 'C')->count();
        $snc = Respuesta::where('estrategia', $estra)->where('respuesta', 'NC')->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }

    public function estrategiacumple($estr)
    {
        $totalcumple = Respuesta::where('estrategia', $estr)->where('respuesta', 'C')->count();

        return $totalcumple;
    }
    public function estrategianocumple($estr)
    {
        $totalnocumple = Respuesta::where('estrategia', $estr)->where('respuesta', 'NC')->count();

        return $totalnocumple;
    }

    public function index()
    {
        //grafico cumplimiento global   
        $tc = Respuesta::where('respuesta', 'C')->count();
        $tnc = Respuesta::where('respuesta', 'NC')->count();
        $totalitems = $tc + $tnc;

        if ($tc or $tnc > 0) {
            $totalcum = $tc / ($tc + $tnc) * 100;
            $totalcum = number_format($totalcum);
        } else {
            $totalcum = 0; //Valor predeterminado        
        }

        if ($tc or $tnc > 0) {
            $totalnocum = $tnc / ($tc + $tnc) * 100;
            $totalnocum = number_format($totalnocum);
        } else {
            $totalnocum = 0; //Valor predeterminado        
        }

        //Consultas
        $cargos = Respuesta::select('cargo')->distinct()->orderBy('cargo', 'asc')->get();
        $servicios = Respuesta::select('servicio')->distinct()->orderBy('servicio', 'asc')->get();
        $estrategias = Respuesta::select('estrategia')->distinct()->orderBy('estrategia', 'asc')->get();

        //grafico cumplimiento servicio
        foreach ($servicios as $serv) {
            $servicio = $serv->servicio;
            $serviciotc = $this->serviciocumple($servicio);
            $serviciotnc = $this->servicionocumple($servicio);
            $resultadoser = $this->cumpliservicio($servicio);
            $datosServicio[] = ['servicio' => $servicio, 'cumplimiento' =>  $resultadoser,
            'totalcumple' =>  $serviciotc,'totalnocumple' =>  $serviciotnc];    
        }
        //grafico cumplimiento cargo
        foreach ($cargos as $carg) {
            $cargo = $carg->cargo;
            $cargotc = $this->cargocumple($cargo);
            $cargotnc = $this->cargonocumple($cargo);
            $resultadocar = $this->cumplicargo($cargo);
            $datosCargo[] = ['cargo' => $cargo, 'cumplimiento' =>  $resultadocar,
            'totalcumple' =>  $cargotc,'totalnocumple' =>  $cargotnc];    
        }
        //grafico cumplimiento estrategia
        foreach ($estrategias as $estr) {
            $estrategia = $estr->estrategia;
            $estrtc = $this->estrategiacumple($estrategia);
            $strtnc = $this->estrategianocumple($estrategia);
            $resultadoest = $this->cumpliestrategia($estrategia);  
            $datosEstrategia[] = ['estrategia' => $estrategia, 'cumplimiento' =>  $resultadoest,
            'totalcumple' =>  $estrtc,'totalnocumple' =>  $strtnc];             
                            
        }              

        $datosServicio = collect($datosServicio)->sortByDesc('cumplimiento');
        $datosCargo = collect($datosCargo)->sortByDesc('cumplimiento');
        $datosEstrategia = collect($datosEstrategia)->sortByDesc('cumplimiento');

        return view('dashboard', compact(
            'datosServicio',
            'datosCargo',
            'datosEstrategia',
            'totalcum',
            'totalnocum', 
            'totalitems',
             'tc', 
             'tnc'                        
        ));
    }
}
