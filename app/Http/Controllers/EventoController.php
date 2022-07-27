<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
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
    public function create($nometorneio, $idpartida, $nomeevento)
    {
        $objEvento = new Evento();
        $idTorneio = $objEvento->buscaIdTorneioPorNome($nometorneio);

        if($idTorneio && $idpartida && $nomeevento) {
            $objEvento->partida = $idpartida;
            $objEvento->torneio = $idTorneio->id;
            $objEvento->descricao_evento = $nomeevento;
            if($objEvento->save() == true) {
                return response()->json([
                    "message" => "Evento cadastrado com sucesso!"
                ], 201);
            } else {
                return response()->json([
                    "message" => "Evento não cadastrado com sucesso gentileza verificar informações imputadas!"
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "A partida e ou torneio não localizados!"
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
    public function show($nome)
    {
        if(Evento::where('descricao_evento', $nome)->exists()) {
            $evento = Evento::where('descricao_evento', $nome)->get()->toJson(JSON_PRETTY_PRINT);
            return response($evento, 200);
        } else {
            return response()->json([
                "message" => "Evento não localizado"
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
        $eventos = Evento::get()->toJson(JSON_PRETTY_PRINT);
        return response($eventos, 200);
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
