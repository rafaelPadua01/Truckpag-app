<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Cidades;
use App\Models\Endereco;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\EnderecoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
*/
Route::get('/', function(){
    return Inertia::render('test');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

//Route to table show cities
Route::post('cidades/export', [CidadesController::class, 'import'])->name('import');

//Route to endereco
Route::get('endereco', [EnderecoController::class, 'index'])->name('index');
Route::post('endereco/store', [EnderecoController::class, 'store'])->name('store');
Route::post('endereco/update/{id}', [EnderecoController::class, 'update'])->name('update');
Route::post('endereco/destroy/{id}', [EnderecoController::class, 'destroy'])->name('destroy');