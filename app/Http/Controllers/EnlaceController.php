<?php

namespace App\Http\Controllers;

use App\Models\Enlace;
use Illuminate\Http\Request;
use App\Http\Requests\EnlaceRequest;

class EnlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enlaces = Enlace::all();
        return response()->json($enlaces, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnlaceRequest $request)
    {
        Enlace::create($request->all());
        return response()->json(['message'=>'Enlace registrado'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(EnlaceRequest $request, Enlace $enlace)
    {        
        $enlace->update($request->all());        
        return response()->json(['message'=>'Enlace actualizado'], 200);
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
