<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table = 'tranferencia';
    protected $fillable = ['id', 'time_origem', 'time_destino', 'jogador', 'data', 'valor'];
}
