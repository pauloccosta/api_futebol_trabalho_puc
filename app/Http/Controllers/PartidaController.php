<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use Illuminate\Http\Request;

class PartidaController extends Controller
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
    public function create($nomeTimeMandante, $nomeTimeVisitante, $nomeTorneio, $data)
    {
        $objPartida = new Partida();
        $idTimeMandante = $objPartida->buscaIdTimePorNome($nomeTimeMandante);
        $idTimeVisitante = $objPartida->buscaIdTimePorNome($nomeTimeVisitante);
        $idTorneio = $objPartida->buscaIdTorneioPorNome($nomeTorneio);

        if($idTimeMandante && $idTimeVisitante && $idTimeVisitante) {
            $objPartida->time_mandante = $idTimeMandante->id;
            $objPartida->time_visitante = $idTimeVisitante->id;
            $objPartida->torneio = $idTorneio->id;
            $objPartida->data = $data;
            if($objPartida->save() == true) {
                return response()->json([
                    "message" => "Partida cadastrada com sucesso!"
                ], 201);
            } else {
                return response()->json([
                    "message" => "Partida não cadastrada com sucesso gentileza verificar informações imputadas!"
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "O time mandante ou time visitante informado e ou torneio não localizados!"
            ], 404);
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
    public function show($id)
    {
        if(Partida::where('id', $id)->exists()) {
            $partida = Partida::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($partida, 200);
        } else {
            return response()->json([
                "message" => "Partida não localizada"
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
        $partidas = Partida::get()->toJson(JSON_PRETTY_PRINT);
        return response($partidas, 200);
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
    public function update($id, $nomeTimeMandante, $nomeTimeVisitante, $nomeTorneio)
    {
        if(Partida::where('id', $id)->exists()) {
            $objPartida = new Partida();    
            $idTimeMandante = $objPartida->buscaIdTimePorNome($nomeTimeMandante);
            $idTimeVisitante = $objPartida->buscaIdTimePorNome($nomeTimeVisitante);
            $idTorneio = $objPartida->buscaIdTorneioPorNome($nomeTorneio);

            $partida = Partida::where('id', $id)->get();
            $partida->toQuery()->update([
                'time_mandante' => $idTimeMandante->id,
                'time_visitante' => $idTimeVisitante->id,
                'torneio' => $idTorneio->id
            ]);
            return response()->json([
                "message" => "Partida alterada com sucesso!"
            ], 200);

        } else {
            return response()->json([
                "message" => "Partida Não encontrada"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Partida::where('id', $id)->exists()) {
            $partida = Partida::where('id', $id)->get();
            $partida->toQuery()->delete();
            return response()->json([
                "message" => "Partida deletada com sucesso!"
            ], 200);

        } else {
            return response()->json([
                "message" => "Partida Não encontrada"
            ], 404);
        }
    }
}
