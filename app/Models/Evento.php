<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Evento extends Model
{
    protected $table = 'evento';
    protected $fillable = ['id', 'partida', 'torneio', 'descricao_evento'];

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
