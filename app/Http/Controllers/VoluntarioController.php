<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Voluntario;

use Carbon\Carbon;

class VoluntarioController extends Controller
{
    /**
     * Create a controller for "Voluntario" resource.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check.token')->except('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['voluntarios' => Voluntario::with('projetos')->get()], 200);
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
        $voluntarioAtributtes = $request->all();

        $voluntarioCreated = Voluntario::create([
            "nome" => $voluntarioAtributtes["nomeCompleto"],
            "cpf" => $voluntarioAtributtes["cpf"],
            "email" => $voluntarioAtributtes["email"],
            "dataNascimento" => Carbon::parse($voluntarioAtributtes["dataNascimento"]),
            "senha" => $voluntarioAtributtes["senha"]
        ]);

        return response()->json(["voluntario" => $voluntarioCreated], 201);
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
