<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Servicio;


class Dashboard2Controller extends Controller
{
    public function cumpliserviciofecha($serv, $fechaini, $fechafin)
    {
        $sc = Respuesta::where('servicio', $serv)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $snc = Respuesta::where('servicio', $serv)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }
    public function serviciocumple($serv, $fechaini, $fechafin)
    {
        $totalcumple = Respuesta::where('servicio', $serv)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalcumple;
    }
    public function servicionocumple($serv, $fechaini, $fechafin)
    {
        $totalnocumple = Respuesta::where('servicio', $serv)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalnocumple;
    }
    //////cumplimiento cargo por fecha
    public function cumplicargofecha($carg, $fechaini, $fechafin)
    {
        $sc = Respuesta::where('cargo', $carg)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $snc = Respuesta::where('cargo', $carg)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }
    public function cargocumple($carg, $fechaini, $fechafin)
    {
        $totalcumple = Respuesta::where('cargo', $carg)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalcumple;
    }
    public function cargonocumple($carg, $fechaini, $fechafin)
    {
        $totalnocumple = Respuesta::where('cargo', $carg)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalnocumple;
    }
    //////cumplimiento cargo por fecha
    public function cumpliestrategiafecha($estra, $fechaini, $fechafin)
    {
        $sc = Respuesta::where('estrategia', $estra)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $snc = Respuesta::where('estrategia', $estra)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }
    public function estrategiacumple($estra, $fechaini, $fechafin)
    {
        $totalcumple = Respuesta::where('estrategia', $estra)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalcumple;
    }
    public function estrategianocumple($estra, $fechaini, $fechafin)
    {
        $totalnocumple = Respuesta::where('estrategia', $estra)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();

        return $totalnocumple;
    }

    public function cumpitems($pregunta, $fechaini, $fechafin)
    {
        $sc = Respuesta::where('pregunta', $pregunta)->where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $snc = Respuesta::where('pregunta', $pregunta)->where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        if ($snc or $sc > 0) {
            $totalcumple = $sc / ($snc + $sc) * 100;
            $totalcumple = number_format($totalcumple);
        } else {
            $totalcumple = 0; //Valor predeterminado        
        }
        return $totalcumple;
    }

    ///////////consulta servicio por fecha
    public function consultasfecha(Request $request)
    {

        $fechaini = $request->input('fechaini');
        $fechafin = $request->input('fechafin');

        $cargos = Respuesta::select('cargo')->distinct()->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('cargo', 'asc')->get();
        $servicios = Respuesta::select('servicio')->distinct()->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('servicio', 'asc')->get();
        $estrategias = Respuesta::select('estrategia')->distinct()->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('estrategia', 'asc')->get();
        $preguntas = Respuesta::select('estrategia', 'pregunta' )->distinct()->whereBetween('fecha', [$fechaini, $fechafin])->orderBy('estrategia', 'asc')->get();

        $tc = Respuesta::where('respuesta', 'C')->whereBetween('fecha', [$fechaini, $fechafin])->count();
        $tnc = Respuesta::where('respuesta', 'NC')->whereBetween('fecha', [$fechaini, $fechafin])->count();

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


        //grafico cumplimiento global   


        foreach ($servicios as $serv) {
            $servicio = $serv->servicio;
            $serviciotc = $this->serviciocumple($servicio, $fechaini, $fechafin);
            $serviciotnc = $this->servicionocumple($servicio, $fechaini, $fechafin);
            $resultadoser = $this->cumpliserviciofecha($servicio, $fechaini, $fechafin);
            $datosServicio[] = [
                'servicio' => $servicio, 'cumplimiento' =>  $resultadoser,
                'totalcumple' =>  $serviciotc, 'totalnocumple' =>  $serviciotnc
            ];
        }
        foreach ($cargos as $carg) {
            $cargo = $carg->cargo;
            $cargotc = $this->cargocumple($cargo, $fechaini, $fechafin);
            $cargotnc = $this->cargonocumple($cargo, $fechaini, $fechafin);
            $resultadocar = $this->cumplicargofecha($cargo, $fechaini, $fechafin);
            $datosCargo[] = [
                'cargo' => $cargo, 'cumplimiento' =>  $resultadocar,
                'totalcumple' =>  $cargotc, 'totalnocumple' =>  $cargotnc
            ];
        }
        foreach ($estrategias as $estra) {
            $estrategia = $estra->estrategia;
            $estrtc = $this->estrategiacumple($estrategia, $fechaini, $fechafin);
            $strtnc = $this->estrategianocumple($estrategia, $fechaini, $fechafin);
            $resultadoestr = $this->cumpliestrategiafecha($estrategia, $fechaini, $fechafin);
            $datosEstrategia[] = [
                'estrategia' => $estrategia, 'cumplimiento' =>  $resultadoestr,
                'totalcumple' =>  $estrtc, 'totalnocumple' =>  $strtnc
            ];
        }

        //items
        foreach ($preguntas as $pre) {
            $estrategia = $pre->estrategia;
            $pregunta = $pre->pregunta;
            $resultadpre = $this->cumpitems($pregunta, $fechaini, $fechafin);
            $datosPregunta[] = ['estrategia' => $estrategia, 'item' => $pregunta, 'cumplimiento' =>  $resultadpre];
        }

        $datosServicio = collect($datosServicio)->sortByDesc('cumplimiento');
        $datosCargo = collect($datosCargo)->sortByDesc('cumplimiento');
        $datosEstrategia = collect($datosEstrategia)->sortByDesc('cumplimiento');
        
        return view('dashboard2', compact(
            'datosServicio',
            'datosCargo',
            'datosEstrategia',
            'datosPregunta',
            'preguntas',
            'servicios',          
            'totalcum',
            'totalnocum',
            'fechaini',
            'fechafin'
        ));
    }
}
