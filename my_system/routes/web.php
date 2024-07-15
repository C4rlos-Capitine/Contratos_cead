<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\FaculdadeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\LecionaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\FlaskApiController;
use App\Http\Controllers\CentroRecursoController;
use App\Http\Controllers\ContratoLaboratorioController;



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


Route::get('/', MainController::class)->middleware('auth')->name('main');

Route::get('/user_log', [AuthController::class, 'show'])->name('login');
Route::post('login', [AuthController::class, 'login']);


Route::get('/logout', [AuthController::class, 'logout']);


//Route::get('/', [AuthController::class, 'show'])->name('login');
Route::middleware(['auth'])->group(function () {

    Route::get('/{ano}', [MainController::class, 'with_ano'])->name('main.with_ano');
    Route::get('/docente/ml_call', [FlaskApiController::class, 'get_prediction_by_teacher'])->name('get_prediction_by_teacher')->middleware('auth');
    Route::get('/docente/ml_call2', [FlaskApiController::class, 'get_prediction_by_subject'])->name('get_prediction_by_subject')->middleware('auth');

    Route::get('contrato/gerar_pdf', [PDFController::class, 'generatePdf'])->middleware('auth');
    Route::get('contrato/pdf', [PDFController::class, 'generatePdf'])->middleware('auth');
    Route::get('contrato/gerar_pdf_lab', [PDFController::class, 'generatePdf_lab'])->middleware('auth');
    
    Route::post('/contrato/create', [ContratoController::class, 'create'])->name('create')->middleware('auth');
    Route::get('/contrato/ver', [ContratoController::class, 'ver'])->name('ver')->middleware('auth');
    Route::get('/contrato/ver_lab', [ContratoLaboratorioController::class, 'ver'])->name('ver')->middleware('auth');
    Route::post('/contrato/ver_lab_save', [ContratoLaboratorioController::class, 'save'])->name('save')->middleware('auth');

    Route::get('/representante/reg', [RepresentanteController::class, 'register_form'])->name('register_form')->middleware('auth');
    Route::get('/docente/ver_disciplinas', [ContratoController::class, 'get_disciplinas_contrato'])->name('get_disciplinas_contrato')->middleware('auth');
    Route::get('/contrato/ver_disciplina_by_email', [ContratoController::class, 'disciplina_by_email'])->name('disciplina_by_email')->middleware('auth');
    Route::post('/contrato/novos_contratos', [ContratoController::class, 'create_contratos_para_ano'])->name('create_contratos_para_ano')->middleware('auth');
    

    Route::get('/curso/reg', [CursoController::class, 'register_form'])->name('register_form')->middleware('auth');
    Route::post('/curso/save', [CursoController::class, 'save'])->name('save')->middleware('auth');
    Route::get('/curso/ver', [CursoController::class, 'get_all'])->name('get_all')->middleware('auth');
    Route::get('/curso/get', [CursoController::class, 'get_by_json'])->name('get_by_json')->middleware('auth');
    Route::get('/curso/get_disciplina_by_ano', [CursoController::class, 'get_disciplinas_byano'])->name('get_disciplinas_byano')->middleware('auth');
    Route::get('/curso/get_disciplinas_nao_associada', [CursoController::class, 'disciplinas_nao_associada'])->name('disciplinas_nao_associada')->middleware('auth');
    Route::get('/curso/estatistica', [CursoController::class, 'get_count_disciplinas_associadas'])->name('get_count_disciplinas_associadas')->middleware('auth');
    Route::get('/curso/sobre', [CursoController::class, 'ver_detalhes'])->name('ver_detalhes')->middleware('auth');
    Route::post('/curso/update', [CursoController::class, 'update'])->name('update')->middleware('auth');
    Route::get('/curso/get_all_nao_ass', [CursoController::class, 'disciplinas_todas_disci_nao_asso'])->name('disciplinas_todas_disci_nao_asso')->middleware('auth');

    
    Route::get('/leciona/check_disciplina', [LecionaController::class, 'check_disciplinas_in_contrato'])->name('check_disciplinas_in_contrato')->middleware('auth');
    Route::get('/leciona/test', [LecionaController::class, 'test'])->name('test')->middleware('auth');

    Route::get('/categoria/reg', [CategoriaController::class, 'register_form'])->name('register_form')->middleware('auth');
    Route::post('/categoria/save', [CategoriaController::class, 'save'])->name('save')->middleware('auth');
    Route::get('/categoria/vizualisar', [CategoriaController::class, 'get_all'])->name('get_all')->middleware('auth');

    Route::get('/disciplina/reg', [DisciplinaController::class, 'register_form'])->name('register_form')->middleware('auth');
    Route::post('/disciplina/save', [DisciplinaController::class, 'save'])->name('save')->middleware('auth');
    Route::get('/disciplina/vizualisar', [DisciplinaController::class, 'get_all'])->name('get_all')->middleware('auth');
    Route::get('/disciplina/get_discplinas_json', [DisciplinaController::class, 'get_discplinas_json'])->name('get_discplinas_json')->middleware('auth');
    //Route::get('/disciplina/get_by_ano', [DisciplinaController::class, 'get_all'])->name('get_all');
    Route::get('/disciplina/associar', [DisciplinaController::class, 'associar_form'])->name('associar_form')->middleware('auth');
    Route::post('/disciplina/associar_save', [DisciplinaController::class, 'associar_ao_curso'])->name('associar_ao_curso')->middleware('auth');
    Route::get('/disciplina/get_disciplinas_only', [DisciplinaController::class, 'get_disciplinas_only'])->name('get_disciplinas_only')->middleware('auth');
    Route::get('/disciplina/get_disciplinas_curso', [DisciplinaController::class, 'get_disciplinas_curso'])->name('get_disciplinas_curso')->middleware('auth');
    Route::get('/disciplina/check_if_alocada', [DisciplinaController::class, 'check_if_alocada'])->name('check_if_alocada')->middleware('auth');
    Route::get('/disciplina/get_by_categoria', [DisciplinaController::class, 'get_by_categoria'])->name('get_by_categoria')->middleware('auth');
    

    Route::get('/docente/reg', [DocenteController::class, 'register_form'])->name('register_form')->middleware('auth');
    Route::post('/docente/save', [DocenteController::class, 'save'])->name('save')->middleware('auth');
    Route::get('/docente/vizualisar', [DocenteController::class, 'get_all'])->name('get_all')->middleware('auth');
    Route::get('/docente/get', [DocenteController::class, 'get'])->name('get')->middleware('auth');
    Route::get('/docente/alocar', [DocenteController::class, 'alocar_disciplina'])->name('alocar_disciplina')->middleware('auth');
    Route::post('/docente/alocar/add_disciplina', [DocenteController::class, 'add_disciplina'])->name('add_disciplina');
    Route::get('/docente/get_disciplinas', [DocenteController::class, 'get_disciplinas'])->name('get_disciplinas')->middleware('auth');
    Route::get('/docente/find', [DocenteController::class, 'find'])->name('find')->middleware('auth');
    Route::get('/docente/count', [DocenteController::class, 'get_count'])->name('get_count')->middleware('auth');
    Route::get('/docente/quantas_disciplinas_ano', [DocenteController::class, 'quantas_disciplinas_ano'])->name('quantas_disciplinas_ano')->middleware('auth');
    Route::get('/docente/by_genero', [DocenteController::class, 'get_count_genero'])->name('get_count_genero')->middleware('auth');
    Route::get('/docente/by_nivel', [DocenteController::class, 'get_count_nivel'])->name('get_count_nivel')->middleware('auth');
    Route::get('/docente/quantas_disciplinas_semestre', [DocenteController::class, 'quantas_disciplinas_semestre'])->name('quantas_disciplinas_semestre')->middleware('auth');
    
    Route::get('/docente/sem_contrato', [DocenteController::class, 'get_docentes_sem_contrato'])->name('get_docentes_sem_contrato')->middleware('auth');
    
    Route::get('/docente/contratados_genero', [DocenteController::class, 'get_count_contrados_genero'])->name('get_count_contrados_genero')->middleware('auth');
    
    Route::get('/contrato/ver_disciplina_by_email', [DocenteController::class, 'disciplina_by_email'])->name('disciplina_by_email')->middleware('auth');
    
    Route::get('/faculdade/reg', [FaculdadeController::class, 'register_form'])->name('register_form')->middleware('auth');
    Route::post('/faculdade/save', [FaculdadeController::class, 'save'])->name('save')->middleware('auth');
    Route::get('/faculdade/vizualisar', [FaculdadeController::class, 'get_all'])->name('get_all')->middleware('auth');
    Route::get('/faculdade/docentes', [FaculdadeController::class, 'get_docentes'])->name('get_docentes')->middleware('auth');
    //Route::get('/centros/teste', [CentroRecursoController::class, 'teste'])->name('teste');
   

   
});
Route::get('/centros/teste', [CentroRecursoController::class, 'teste'])->name('teste');
Route::post('/disciplina/associar_save', [DisciplinaController::class, 'associar_ao_curso'])->name('associar_ao_curso');
