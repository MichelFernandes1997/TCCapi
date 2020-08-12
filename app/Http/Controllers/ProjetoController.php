<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Projeto;

use Carbon\Carbon;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projetos = Projeto::with('ong', 'voluntarios')->get();

        return response()->json(["projetos" => $projetos], 200);
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
        $projetoAtributtes = $request->all();

        $projetoCreated = Projeto::create([
            "nome" => $projetoAtributtes["nome"],
            "descricao" => $projetoAtributtes["descricao"],
            "dataInicio" => Carbon::parse($projetoAtributtes["dataInicio"]),
            "dataTermino" => Carbon::parse($projetoAtributtes["dataTermino"]),
            "endereco" => $projetoAtributtes["endereco"],
            "ong_id" => $projetoAtributtes["ong_id"],
        ]);

        return response()->json(["projeto" => $projetoCreated], 201);
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
        $updateAtributtes = $request->all();

        $projetoWillUpdate = Projeto::find($id);

        
        foreach($updateAtributtes as $key => $value)
        {
            if ($key === 'voluntario_id') {
                $projetoWillUpdate->voluntarios()->attach([$value]);
            } else if($key === 'detach_voluntario_id') {
                $projetoWillUpdate->voluntarios()->detach([$value]);
            } else {
                $projetoWillUpdate->$key = $value;
            }
        }

        $projetoWillUpdate->save();
        

        return response()->json(["projeto" => $projetoWillUpdate], 200);
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
