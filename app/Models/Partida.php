<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Partida extends Model
{
    protected $table = 'partida';
    protected $fillable = ['id', 'data', 'time_mandante', 'time_visitante', 'torneio'];

    public function buscaDadosDaPartida($nomeTimeMandante, $nomeTimeVisitante, $nomeTorneio)
    {
        $partidas = DB::table('partida')
        ->join('time', 'partida.time_mandante', '=', 'time.id')
        ->join('time as tt', 'partida.time_visitante', '=', 'tt.id')
        ->join('torneio', 'partida.torneio', '=', 'torneio.id')
        ->select('partida.*', 'time.nome as nome_mandante', 'tt.nome as nome_visitante', 'torneio.nome')
        ->where(['time.nome' => $nomeTimeMandante, 'tt.nome' => $nomeTimeVisitante, 'torneio.nome' => $nomeTorneio])
        ->get();
       
        if(!isset($partidas[0]->time_id_time)) {
            return false;
        } else {
            return $partidas[0];
        }
    }

    public function buscaIdTimePorNome($nomeTime)
    {
        $idTime = DB::table('time')
        ->select('time.nome as nome_time', 'time.id as id')
        ->where(['time.nome' => $nomeTime])
        ->get();
       
        if(count($idTime) < 1 ) {
            return false;
        } else {
            return $idTime[0];
        }
    }

    public function buscaIdTorneioPorNome($nomeTorneio)
    {
        $idTorneio = DB::table('torneio')
        ->select('torneio.nome as nome_torneio', 'torneio.id as id')
        ->where(['torneio.nome' => $nomeTorneio])
        ->get();
       
        if(count($idTorneio) < 1 ) {
            return false;
        } else {
            return $idTorneio[0];
        }
    }

}
