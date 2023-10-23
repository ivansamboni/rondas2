<?php

namespace App\Http\Controllers;

use App\Http\Requests\RespuestaRequest;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Estrategia;
use App\Models\Servicio;
use App\Models\Cargo;
use App\Models\Respuesta;
use App\Models\Auditoria;
use Carbon\Carbon;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estrategia = Estrategia::with('item')->orderBy('estrategia', 'asc')->get();
        return view('auditar', compact('estrategia'));
    }

    public function buscar(Request $request)
    {
        $id = $request->input('id');
        $estra = Estrategia::findOrFail($id);
        $nameestra = $estra->estrategia;
        $servicio = Servicio::orderby('servicio', 'asc')->get();
        $cargo = Cargo::orderby('cargo', 'asc')->get();
        $item = Item::where('estrategia_id', $id)->get();

        return view('auditar2', compact('item', 'estra', 'servicio', 'cargo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        foreach ($request->pregunta as $key => $pregunta) {
            $auditar['pregunta'] = $pregunta;
            $auditar['respuesta'] = $request->respuesta[$key];
            $auditar['estrategia'] = $request->estrategia;
            $auditar['servicio'] = $request->servicio;
            $auditar['cargo'] = $request->cargo;
            $auditar['observacion'] = $request->observacion;
            $auditar['auditor'] = $request->auditor;
            $auditar['fecha'] = Carbon::now();
            Respuesta::create($auditar);
           
        }          
                $auditoria = $request->auditoria;
                Auditoria::where('auditoria', $auditoria)->delete();         
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
