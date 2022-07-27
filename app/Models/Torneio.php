<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneio extends Model
{
    protected $table = 'torneio';
    protected $fillable = ['id', 'nome'];
}
