<?php

namespace App\Http\Controllers;

use App\Models\Torneio;
use Illuminate\Http\Request;

class TorneioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nomeTorneio)
    {
        $torneio = new Torneio();
        $torneio->nome = $nomeTorneio;
        if($torneio->save() == true) {
            return response()->json([
                "message" => "Torneio salvo com sucesso!"
            ], 201);
        } else {
            return response()->json([
                "message" => "Torneio não salvo gentileza verificar o nome do torneio!"
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nome)
    {
        if(Torneio::where('nome', $nome)->exists()) {
            $torneio = Torneio::where('nome', $nome)->get()->toJson(JSON_PRETTY_PRINT);
            return response($torneio, 200);
        } else {
            return response()->json([
                "message" => "Torneio não localizado"
            ], 404);
        }
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $torneios = Torneio::get()->toJson(JSON_PRETTY_PRINT);
        return response($torneios, 200);
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
     * @param  string  $nome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nome)
    {
        if(Torneio::where('nome', $nome)->exists()) {
            $torneio = Torneio::where('nome', $nome)->get();
            $torneio->toQuery()->update([
                'nome' => $request->novo_nome_torneio,
            ]);
            return response()->json([
                "message" => "Torneio alterado com sucesso!"
            ], 200);

        } else {
            return response()->json([
                "message" => "Torneio Não encontrado"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nomeTorneio)
    {
        if(Torneio::where('nome', $nomeTorneio)->exists()) {
            $torneio = Torneio::where('nome', $nomeTorneio)->get();
            $torneio->toQuery()->delete();
            return response()->json([
                "message" => "Torneio deletado com sucesso!"
            ], 200);

        } else {
            return response()->json([
                "message" => "Torneio Não encontrado"
            ], 404);
        }
    }
}
