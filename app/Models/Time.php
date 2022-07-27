<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
   protected $table = 'time';
   protected $fillable = ['id', 'nome', 'localidade'];
}
