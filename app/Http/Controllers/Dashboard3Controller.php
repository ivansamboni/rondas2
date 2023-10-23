<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;

class Dashboard3Controller extends Controller
{

    //////cumplimiento cargo por fecha
    public function cumplicargofecha($serv, $carg, $fechaini, $fechafin)
    {
        $sc = Respuesta::where('servicio', $serv)->where('cargo', $carg)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $snc = Respuesta::where('servicio', $serv)->where('cargo', $carg)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }
    public function cargocumple($serv, $carg, $fechaini, $fechafin)
    {
        $totalcumple = Respuesta::where('servicio', $serv)->where('cargo', $carg)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalcumple;
    }
    public function cargonocumple($serv, $carg, $fechaini, $fechafin)
    {
        $totalnocumple = Respuesta::where('servicio', $serv)->where('cargo', $carg)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalnocumple;
    }
    //////cumplimiento cargo por fecha
    public function cumpliestrategiafecha($serv, $estra, $fechaini, $fechafin)
    {
        $sc = Respuesta::where('servicio', $serv)->where('estrategia', $estra)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $snc = Respuesta::where('servicio', $serv)->where('estrategia', $estra)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }
    public function estrategiacumple($serv, $estra, $fechaini, $fechafin)
    {
        $totalcumple = Respuesta::where('servicio', $serv)->where('estrategia', $estra)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalcumple;
    }
    public function estrategianocumple($serv, $estra, $fechaini, $fechafin)
    {
        $totalnocumple = Respuesta::where('servicio', $serv)->where('estrategia', $estra)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalnocumple;
    }

    public function perfilcumplimiento($carg, $serv, $estra, $fechaini, $fechafin)
    {
        $sc = Respuesta::where('cargo', $carg)->where('servicio', $serv)->where('estrategia', $estra)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $snc = Respuesta::where('cargo', $carg)->where('servicio', $serv)->where('estrategia', $estra)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }

    public function cumpitems($pregunta, $serv , $fechaini, $fechafin)
    {
        $sc = Respuesta::where('pregunta', $pregunta)->where('servicio', $serv)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $snc = Respuesta::where('pregunta', $pregunta)->where('servicio', $serv)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }


    public function desagregarservicio(Request $request)
    {
        $serv = $request->input('servicio');
        $fechaini = $request->input('fechaini');
        $fechafin = $request->input('fechafin');

        $tc = Respuesta::where('servicio', $serv)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $tnc = Respuesta::where('servicio', $serv)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();

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

        $cargos = Respuesta::select('cargo')->distinct()->where('servicio', $serv)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('cargo', 'asc')->get();
        $estrategias = Respuesta::select('estrategia')->distinct()->where('servicio', $serv)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('estrategia', 'asc')->get();
        $estraperfil = Respuesta::select('cargo','estrategia')->distinct()->where('servicio', $serv)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('cargo', 'asc')->get();
        $preguntas = Respuesta::select('estrategia', 'pregunta' )->distinct()->where('servicio', $serv)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('estrategia', 'asc')->get();
        $observaciones = Respuesta::select('cargo','estrategia','observacion','auditor','fecha')->distinct()->where('observacion','NOT LIKE', '')->where('servicio', $serv)->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('fecha', 'desc')->get();
        //grafico cumplimiento global   


        foreach ($cargos as $carg) {
            $cargo = $carg->cargo;
            $cargotc = $this->cargocumple($serv, $cargo, $fechaini, $fechafin);
            $cargotnc = $this->cargonocumple($serv, $cargo, $fechaini, $fechafin);
            $resultadocar = $this->cumplicargofecha($serv, $cargo, $fechaini, $fechafin);

            $datosCargo[] = [
                'cargo' => $cargo, 'cumplimiento' =>  $resultadocar,
                'totalcumple' =>  $cargotc, 'totalnocumple' =>  $cargotnc
            ];
        }

        foreach($estraperfil as $carg){
            $cargo = $carg->cargo;
            $estrategia = $carg->estrategia;
            $resultadoperfil = $this->perfilcumplimiento($cargo, $serv, $estrategia, $fechaini, $fechafin);
            $datosPerfil[] = [
                'cargo' => $cargo, 'estrategia' => $estrategia, 'cumplimiento' =>  $resultadoperfil
            ];
        }

        foreach ($estrategias as $estra) {
            $estrategia = $estra->estrategia;
            $estrtc = $this->estrategiacumple($serv, $estrategia, $fechaini, $fechafin);
            $strtnc = $this->estrategianocumple($serv, $estrategia, $fechaini, $fechafin);            
            $resultadoestr = $this->cumpliestrategiafecha($serv, $estrategia, $fechaini, $fechafin);
            $datosEstrategia[] = [
                'estrategia' => $estrategia, 'cumplimiento' =>  $resultadoestr,
                'totalcumple' =>  $estrtc, 'totalnocumple' =>  $strtnc
            ];
          
        }

        foreach ($preguntas as $pre) {
            $estrategia = $pre->estrategia;
            $pregunta = $pre->pregunta;
            $resultadpre = $this->cumpitems($pregunta,$serv, $fechaini, $fechafin);
            $datosPregunta[] = ['estrategia' => $estrategia, 'item' => $pregunta, 'cumplimiento' =>  $resultadpre];
        }

        $datosCargo = collect($datosCargo)->sortByDesc('cumplimiento');
        $datosEstrategia = collect($datosEstrategia)->sortByDesc('cumplimiento');
        
        return view('dashboard3', compact(
            'datosCargo',
            'datosEstrategia',
            'datosPerfil',
            'datosPregunta',
            'totalcum',
            'totalnocum',
            'fechaini',
            'fechafin',
            'serv',
            'observaciones'
        ));
    }
}
