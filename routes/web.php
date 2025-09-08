<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LaudoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Rotas de Cadastro de Usuário
Route::get('/cadastro', [CadastroController::class, 'create'])->name('cadastro.create');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');

// Rotas de Cadastro de Médico
Route::get('/cadastromedico', [MedicoController::class, 'create'])->name('cadastromedico.create');
Route::post('/cadastromedico', [MedicoController::class, 'store'])->name('cadastromedico.store');

// Autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Recuperação de senha
Route::get('/recuperacao', fn() => view('recuperacao'))->name('recuperacao');
Route::get('/redefinicao', fn() => view('redefinicao'))->name('redefinicao');

// Páginas estáticas
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/termos-de-servico', 'termos-de-servico')->name('termos');
Route::view('/escolha', 'escolha')->name('escolha');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Área do usuário
    Route::get('/area-usuario', fn () => view('area-user'))->name('area.usuario');
    Route::get('/area', fn () => redirect()->route('area.usuario'))->name('area-user');

    // Perfil
    Route::get('/perfil', fn () => view('perfil'))->name('perfil');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('perfil.update');

    // Salas
    Route::get('/salas', [SalaController::class, 'index'])->name('salas.index');
    Route::get('/criar-salas', [SalaController::class, 'create'])->name('salas.create');
    Route::post('/salas', [SalaController::class, 'store'])->name('salas.store');

    // Laudos
    Route::get('/cadastrolaudo', fn() => view('cadastrolaudo'))->name('cadastrolaudo');
    Route::post('/laudo', [LaudoController::class, 'store'])->name('laudo.store');

});

// Rotas específicas para médicos
Route::middleware(['auth', 'auth.medicos'])->group(function () {
    Route::get('/perfil-medico', fn () => view('perfil-medico'))->name('perfil.medico');
});

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
