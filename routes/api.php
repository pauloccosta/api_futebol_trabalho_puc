<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\JogadorController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\TimetorneioController;
use App\Http\Controllers\TorneioController;
use App\Http\Controllers\TransferenciaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('eventos', [EventoController::class, 'showAll']);
Route::get('eventos/{nome}', [EventoController::class, 'show']);
Route::post('eventos/nometorneio/{nometorneio}/partida/{idpartida}/eventos/{nomeevento}', [EventoController::class, 'create']);

Route::get('jogadores', [JogadorController::class, 'showAll']);
Route::get('jogadores/{nome}', [JogadorController::class, 'show']);

Route::get('partidas', [PartidaController::class, 'showAll']);
Route::get('partidas/{id}', [PartidaController::class, 'show']);
Route::post('partidas/timemandante/{nomeTimeMandante}/timevisitante/{nomeTimeVisitante}/torneio/{nomeTorneio}/datapartida/{data}', [PartidaController::class, 'create']);
Route::put('partidas/{id}/timemandante/{nomeTimeMandante}/timevisitante/{nomeTimeVisitante}/torneio/{nomeTorneio}', [PartidaController::class, 'update']);
Route::delete('partidas/{id}', [PartidaController::class, 'destroy']);

Route::get('times', [TimeController::class, 'showAll']);
Route::get('times/{nome}', [TimeController::class, 'show']);

Route::get('torneios', [TorneioController::class, 'showAll']);
Route::get('torneios/{nome}', [TorneioController::class, 'show']);
Route::post('torneios/{nome}', [TorneioController::class, 'create']);
Route::put('torneios/{nome}', [TorneioController::class, 'update']);
Route::delete('torneios/{nome}', [TorneioController::class, 'destroy']);

Route::get('transferencias', [TransferenciaController::class, 'showAll']);
Route::get('transferencias/{id}', [TransferenciaController::class, 'show']);

Route::get('timetorneio', [TimetorneioController::class, 'showAll']);
Route::get('timetorneio/{nomeTime}', [TimetorneioController::class, 'showTorneiosTime']);
Route::get('timetorneio/{nomeTime}/torneio/{nomeTorneio}', [TimetorneioController::class, 'show']);
Route::post('timetorneio/{nomeTime}/torneio/{nomeTorneio}', [TimetorneioController::class, 'create']);
Route::delete('timetorneio/{nomeTime}/torneio/{nomeTorneio}', [TimetorneioController::class, 'destroy']);
