<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Estrategia;
use App\Models\Item;
use App\Models\Auditoria;

use Illuminate\Http\Request;

class AuditarController extends Controller
{


   public function estralist()
   {

      $estrategia = Estrategia::orderby('estrategia', 'asc')->get();

      return response()->json($estrategia);
   }

   public function estrashow($id)
   {

      $item = Item::where('estrategia_id', $id)->pluck('item');

      return response()->json($item);
   }

   public function store(Request $request)
   {
      $request->validate([
         'auditoria' => 'required|unique:auditorias'
      ]);

      foreach ($request->respuesta as $key => $respuesta) {
         $estimatesAdd['respuesta'] = $respuesta;
         $estimatesAdd['pregunta'] = $request->pregunta[$key];
         $estimatesAdd['estrategia'] = $request->estrategia;
         $estimatesAdd['servicio'] = $request->servicio;
         $estimatesAdd['cargo'] = $request->cargo;
         $estimatesAdd['observacion'] = $request->observacion;
         $estimatesAdd['auditoria'] = $request->auditoria;
         $estimatesAdd['estrategia_id'] = $request->estrategia_id;
         $estimatesAdd['fecha'] = Carbon::now();
         Auditoria::create($estimatesAdd);
      }
   }

   public function auditoriaslist()
   {
      $auditoria = Auditoria::select('auditoria')->distinct()->orderby('auditoria', 'asc')->get();

      return response()->json($auditoria);
   }

   public function auditshow($auditoria)
   {
      $auditorias = Auditoria::where('auditoria', $auditoria)->get();

      return response()->json($auditorias);
   }

   public function auditdelete($auditoria)
   {
    
      $auditorias= Auditoria::where('auditoria', $auditoria)->delete();

      return response()->json($auditorias);
   }
}
