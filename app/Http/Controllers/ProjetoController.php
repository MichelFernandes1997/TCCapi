<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Projeto;

use Carbon\Carbon;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource in index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projetos = Projeto::with('ong', 'voluntarios')->orderBy('id', 'desc')->take(11)->get();

        return response()->json(["projetos" => $projetos], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($ong_id)
    {
        $projetos = Projeto::with('ong', 'voluntarios')->where('ong_id', $ong_id)->orderBy('id', 'desc')->get();

        return response()->json(["projetos" => $projetos], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $projetos = Projeto::with('ong', 'voluntarios')->orderBy('id', 'desc')->get();

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
        $projeto = Projeto::with('ong', 'voluntarios')->where('id', $id)->get();

        return response()->json(["projeto" => $projeto->first()], 200);
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
            } else if ($key === 'dataInicio') {
                $projetoWillUpdate->$key = Carbon::parse($value);
            } else if ($key === 'dataTermino') {
                $projetoWillUpdate->$key = Carbon::parse($value);
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
