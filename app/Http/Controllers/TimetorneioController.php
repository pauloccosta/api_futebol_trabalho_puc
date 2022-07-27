<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\TimeTorneio;
use Illuminate\Http\Request;

class TimetorneioController extends Controller
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
    public function create($nomeTime, $nomeTorneio)
    {
        $objTimeTorneio = new TimeTorneio();
        $idTime = $objTimeTorneio->buscaIdTimePorNome($nomeTime);
        $idTorneio = $objTimeTorneio->buscaIdTorneioPorNome($nomeTorneio);
        if($idTime && $idTorneio) {
            $torneioTime = new TimeTorneio();
            $torneioTime->time_id_time = $idTime->id;
            $torneioTime->torneio_id_torneio = $idTorneio->id;
            if($torneioTime->save() == true) {
                return response()->json([
                    "message" => "Time cadastrado no Torneio com sucesso!"
                ], 201);
            } else {
                return response()->json([
                    "message" => "Time não salvo no torneio gentileza verificar as informações!"
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "O time informado e ou torneio não localizados!"
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
    public function show($nomeTime, $nomeTorneio)
    {
        $objTimeTorneio = new TimeTorneio();
        $daDosTorneioTime = $objTimeTorneio->buscaTimeTorneioPorNome($nomeTime, $nomeTorneio);
        
        if($daDosTorneioTime) {
            return response(json_encode($daDosTorneioTime, JSON_PRETTY_PRINT), 200);
        } else {
            return response()->json([
                "message" => "Time não localizado no torneio!"
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTorneiosTime($nomeTime)
    {
        $objTimeTorneio = new TimeTorneio();
        $daDosTorneioTime = $objTimeTorneio->buscaTorneiosPorTime($nomeTime);
        
        if($daDosTorneioTime) {
            return response(json_encode($daDosTorneioTime, JSON_PRETTY_PRINT), 200);
        } else {
            return response()->json([
                "message" => "Time não foi localizado em nenhum torneio!"
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
        $torneios = TimeTorneio::get()->toJson(JSON_PRETTY_PRINT);
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
    public function destroy($nomeTime, $nomeTorneio)
    {
        $objTimeTorneio = new TimeTorneio();
        $idTime = $objTimeTorneio->buscaIdTimePorNome($nomeTime);
        $idTorneio = $objTimeTorneio->buscaIdTorneioPorNome($nomeTorneio);
        if($idTime && $idTorneio) {
            if((TimeTorneio::where(['time_id_time' => $idTime->id, 'torneio_id_torneio' => $idTorneio->id])->delete()) == true) {
                return response()->json([
                    "message" => "Time excluído do Torneio com sucesso!"
                ], 204);
            } else {
                return response()->json([
                    "message" => "Não foi possível excluir o time do torneio gentileza verificar as informações!"
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "O time informado e ou torneio não localizados!"
            ], 404);
        }
    }
}
