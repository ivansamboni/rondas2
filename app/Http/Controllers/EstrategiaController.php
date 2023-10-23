<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Estrategia;
use App\Models\Item;


class EstrategiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estrategia = Estrategia::with('item')->orderBy('estrategia', 'asc')->get();
        return response()->json($estrategia);
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
    public function store(Request $request, Estrategia $estrategia)
    {
        $request->validate([

            'estrategia' => 'required',

        ]);

        $estrategia =  Estrategia::create($request->all());

        return response()->json(['estrategia' => $estrategia]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estrategia = Item::where('estrategia_id', $id)->get();
        return response()->json($estrategia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }
    public function fetch($id)
    {
        $estrategia = Estrategia::where('id', $id)->get();
        return response()->json($estrategia);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estrategia $estrategia)
    {
        $estrategia->fill($request->post())->save();
        return response()->json(['estrategia' => $estrategia]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estrategia $estrategia)
    {
        $estrategia->delete();
        return response()->json(['mensaje' => 'Se eliminó']);
    }
}
