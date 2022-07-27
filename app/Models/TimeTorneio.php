<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TimeTorneio extends Model
{
    protected $table = 'time_torneio';
    protected $fillable = ['time_id_time', 'torneio_id_torneio', 'nome'];

    public function times() {
        return $this->belongsTo(Time::class, 'time_id_time');
    }

    public function torneio() {
        return $this->belongsTo(Torneio::class, 'torneio_id_torneio');
    }

    public function buscaTimeTorneioPorNome($nomeTime, $nomeTorneio)
    {
        $timeTorneio = DB::table('time_torneio')
        ->join('time', 'time_torneio.time_id_time', '=', 'time.id')
        ->join('torneio', 'time_torneio.torneio_id_torneio', '=', 'torneio.id')
        ->select('time_torneio.*', 'time.nome as nome_time', 'torneio.nome as nome_torneio')
        ->where(['time.nome' => $nomeTime, 'torneio.nome' => $nomeTorneio])
        ->get();
       
        if(!isset($timeTorneio[0]->time_id_time)) {
            return false;
        } else {
            return $timeTorneio[0];
        }
    }

    public function buscaTorneiosPorTime($nomeTime)
    {
        $listaTorneioTimes = DB::table('time_torneio')
        ->join('time', 'time_torneio.time_id_time', '=', 'time.id')
        ->join('torneio', 'time_torneio.torneio_id_torneio', '=', 'torneio.id')
        ->select('time_torneio.*', 'time.nome as nome_time', 'torneio.nome as nome_torneio')
        ->where(['time.nome' => $nomeTime])
        ->get();
       
        if(count($listaTorneioTimes) < 1 ) {
            return false;
        } else {
            foreach ($listaTorneioTimes as $key => $value) {
                $aDadosRetorno[] = $value->nome_torneio;
             }
            return $aDadosRetorno;
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
