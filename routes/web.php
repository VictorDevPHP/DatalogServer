<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CadastroEquipamentosController;
use App\Http\Controllers\DadosNobreakController;
use App\Http\Controllers\ListaEquipamentos;
use App\Models\Equipamentos;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Atividades;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');

});
//------------------Rota para gerar relatorios de logs----------------------------------------


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DadosNobreakController::class, 'index'])->name('dashboard');
});

//------------------Rota para criar um novo usuario----------------------------------------
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


// ------------------Rota para criar um novo usuario----------------------------------------
// Route::get('/register', 'App\Http\Controllers\RegisterController@index')->name('register');

//------------------Rota para abrir o datalog dos nobreaks
Route::get('/datalog', 'App\Http\Controllers\DatalogController@index')->name('datalog');


//------------------Rota para o painel de configuração
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/painelnobreak', 'App\Http\Controllers\PainelnobreakController@index')->name('painelnobreak');
});


//------------------Rota para cadastro de novo equipamento
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/cadastroequipamento', [CadastroEquipamentosController::class, 'index'])->name('cadastroequipamento');
    Route::post('/cadastroequipamento', [CadastroEquipamentosController::class, 'store'])->name('cadastroequipamento');
    Route::get('listaEquipamentos', [ListaEquipamentos::class, 'render'])->name('listaEquipamentos');
    Route::get('/nav/logs', [Atividades::class, 'render'])->name('logAtividades');
    Route::get('/nav/logs', [Atividades::class, 'show'])->name('logAtividades');
});
// ------------------Rota para exportação em csv
Route::get('/nobreaks/export/id={id}', function ($id) {
    $dadosNobreak = App\Models\DadosNobreak::where('id_equipamento', $id)->get();

    // Define o nome do arquivo
    $equipamento = App\Models\Equipamentos::find($id);
    $fileName = $equipamento->nome . '.csv';

    // Cria um arquivo temporário para armazenar o CSV
    $tempFile = tmpfile();

    // Escreve os dados no arquivo CSV
    fputcsv($tempFile, ['ID Equipamento', 'Data Cadastro', 'Log']);
    foreach ($dadosNobreak as $dados) {
        fputcsv($tempFile, [
            $dados->id_equipamento,
            $dados->data_cadastro,
            $dados->log,
        ]);
    }

    // Move o ponteiro do arquivo para o início
    rewind($tempFile);

    // Cria uma resposta HTTP com o arquivo CSV como anexo
    return response()->streamDownload(function () use ($tempFile) {
        fpassthru($tempFile);
    }, $fileName, [
        'Content-Type' => 'text/csv',
        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        'Pragma' => 'public',
        'Expires' => '0',
    ]);
})->name('nobreaks.export.id');

Route::get('/logs/{id}', [DadosNobreakController::class, 'getLogs'])->name('nobreaks.logs');


