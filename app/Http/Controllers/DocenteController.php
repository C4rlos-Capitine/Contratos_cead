<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Leciona;
use App\Models\Tipo_contrato;
use \App\Models\User;
use \App\Models\Contrato;
use \App\Models\Disciplina;
use \App\Models\Faculdade;
use \App\Models\ano_contrato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class DocenteController extends Controller
{
    public function register_form(){
        $niveis = Nivel::all();
        $faculdades = Faculdade::all();
        return view('docente.reg_form', ['niveis'=>$niveis, 'faculdades'=>$faculdades]);
    }

    public function save(Request $request){
        try {
            // Validar os campos
            $rules = [
                'email' => 'required|email|unique:users,email|unique:docentes,email',
                'bi' => 'required|size:13|unique:docentes,bi',
                'nuit' => 'required|size:8|unique:docentes,nuit',
                'genero'=> 'required'
            ];
    
            // Custom error messages
            $messages = [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O email deve ser um endereço de email válido.',
                'email.unique' => 'O email já está em uso.',
                'bi.required' => 'O campo BI é obrigatório.',
                'bi.size' => 'O BI deve ter exatamente 14 caracteres.',
                'bi.unique' => 'O BI já está em uso.',
                'nuit.required' => 'O campo NUIT é obrigatório.',
                'nuit.size' => 'O NUIT deve ter exatamente 8 caracteres.',
                'nuit.unique' => 'O NUIT já está em uso.',
                'genero.required' => 'Selecione o genero'
            ];
    
            // Perform validation
            $validator = Validator::make($request->all(), $rules, $messages);
    
            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['response' => 'Erro de validação', 'errors' => $validator->errors()]);
            }
    
            // Criar um novo usuário
            $user = new User;
            $user->name = $request->nome; 
            $user->email = $request->email;
            $user->password = Hash::make('zxcvbnm');
            $user->tipo_user = 2;
            $user->save();
            
            // Criar um novo docente
            $docente = new Docente;
            $docente->nome_docente = $request->nome;
            $docente->apelido_docente = $request->apelido;
            $docente->nuit = $request->nuit;
            $docente->bi = $request->bi;
            $docente->nacionalidade = $request->nacionalidade;
            $docente->id_nivel = $request->nivel;
            $docente->email = $request->email;
            $docente->genero = $request->genero;
            $docente->id_faculdade_in_docente = $request->faculdade;
            $docente->save();
            
            // Retornar o ID do docente recém-criado
            return response()->json([
                "response" => "Docente {$docente->nome_docente} Registado com sucesso",
                "id_docente" => $docente->id_docente // Aqui é onde você retorna o ID gerado
            ]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
    }

    public function ver_info($id_docente = null){
        try{
            $docente = Docente::select("*")->where('id_docente', '=', $id_docente)->get()->first();
            return view('docente.info', ['docente'=>$docente]);

        }catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
        
    }
    
    

    public function find($id_docente=null)
    {
        $docente = Docente::select('*')
            ->join('nivels', 'nivels.id_nivel', '=', 'docentes.id_nivel')
            ->join('faculdades', 'faculdades.id_faculdade', '=', 'docentes.id_faculdade_in_docente')
            ->where('id_docente', $id_docente)
            ->first();
        //$docente = Docente::where('email', $request->email)
        //return response()->json($docente);
            return view('docente.dados', ['docente' => $docente])->render();
    }
 

    public function get_all(Request $request){
        $docente = Docente::select('*')
            ->join('nivels', 'nivels.id_nivel', '=', 'docentes.id_nivel')
            ->join('faculdades', 'faculdades.id_faculdade', '=', 'docentes.id_faculdade_in_docente')
            ->get();
        if(!isset($request->json)){
            
            return view('docente.vizualisar', ['docentes' => $docente])->render();
        }else{
            return response()->json($docente);
        }
        
        //return response()->json($docente);
    }

    public function get_count(){
        return response()->json(["response"=>Docente::count()]);
    }

    public function get_count_genero(){
        $total = Docente::count();
        $masculino = Docente::where('genero', 'masculino')->count();
        $femenino = Docente::where('genero', 'femenino')->count();
        return response()->json(['total'=>$total, 'masculino'=>$masculino, 'femenino'=>$femenino]);
    }

    public function get_count_nivel(){
        $total = Docente::count();
        $licenciado = Docente::where('id_nivel', 1)->count();
        $mestre = Docente::where('id_nivel', 2)->count();
        $doutor = Docente::where('id_nivel', 3)->count();
        return response()->json(['total'=>$total, 'licenciado'=>$licenciado, 'mestre'=>$mestre, 'doutor'=>$doutor]);
    }

    public function get_count_contrados_genero(Request $request){
        //$total = Contrato::count();
        $masculino = DB::table('contratos')->join('docentes', 'docentes.id_docente', '=', 'contratos.id_docente_in_contrato')->where('docentes.genero', 'masculino')->where('contratos.ano_contrato', $request->ano)->count();
        $femenino = DB::table('contratos')->join('docentes', 'docentes.id_docente', '=', 'contratos.id_docente_in_contrato')->where('docentes.genero', 'femenino')->where('contratos.ano_contrato', $request->ano)->count();
        $total = $masculino + $femenino;
        return response()->json(['total'=>$total, 'masculino'=>$masculino, 'femenino'=>$femenino]);
    }

    public function alocar_disciplina(){
        $cursos = Curso::all();
        $tipos_contrato = Tipo_contrato::all();
        return view('docente.alocar_disciplinas_form', ['cursos' => $cursos]);
    }

    public static function quantas_disciplinas_ano($id_docente, $ano)
    {//$id_docente, $ano
        $lecionas = Leciona::select('lecionas.*')
        ->join('docentes', 'docentes.id_docente', '=', 'lecionas.id_docente_in_leciona')
        ->join('disciplinas', 'disciplinas.codigo_disciplina', '=', 'lecionas.codigo_disciplina_in_leciona')
        ->where('lecionas.ano_contrato', $ano)->where('id_docente', $id_docente)->get()
        ->count();
        return intval($lecionas);

    }

    public static function quantas_disciplinas_semestre($id_docente, $codigo_disciplina, $ano){

        $semestre = Disciplina::select('semestre')->where('codigo_disciplina', $codigo_disciplina)
        ->get()->first();


        $disciplinas = DB::table('lecionas')
        ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
        ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
        ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
        ->where('lecionas.id_docente_in_leciona', $id_docente)
        ->where('lecionas.ano_contrato', $ano)
        ->where('docentes.id_docente', $id_docente)
        ->where('disciplinas.semestre', $semestre->semestre)
        ->get()->count();
        return intval($disciplinas);
        
        //return response()->json($disciplinas);
    }

    public function check_if_alocada($codigo_disciplina, $ano){
        $exists = Leciona::select('codigo_disciplina')
        ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
        ->where('lecionas.ano_contrato', $ano)
        ->where('disciplinas.codigo_disciplina', $codigo_disciplina)
        ->exists();
        return $exists;
    }

    public function add_disciplina(Request $request) {
        try {
            //return response()->json(["response"=>$request->all()]);
            //$cont = App\Http\Controllers\LecionaController check_disciplinas_in_contrato($request);
            $rules = [
                'ano' => 'required',
                'id_docente' => 'required',
                'codigo_disciplina' => 'required',
                'id_curso' => 'required',
                //'tipo_contrato' => 'required'
                // Add other validation rules as needed
            ];

             // Custom error messages
             $messages = [
               'ano.required' => 'Informe o ano do contrato',
               'id_docente' => '[ERRO: ID_Docente não encontrado]',
               'id_docente.required' => 'Pesquise o docente e clique no docente que aparecer na lista que aparecer',
               'id_curso.required' => 'Curso não selecionado',
               'codigo_disciplina.required' => 'Selecione a a Disciplina',
               //'tipo_contrato.required' => 'Selecione o tipo de contrato'
                // Add other custom error messages as needed
            ];
    
            // Perform validation
            $validator = Validator::make($request->all(), $rules, $messages);
    
            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status'=>0]);
            }


            if(!DB::table('ano_contratos')->where('ano_contrato', $request->ano)->exists()){
                return response()->json(['response' => 'Processo de contratação para '.$request->ano.' não iniciado <a href="../contrato/ver">siga o link </a> ', 'status'=>0]);
            }
            //return response()->json(['response' => DocenteController::quantas_disciplinas_ano($request->id_docente, $request->ano), 'status'=>0]);
            
            if(DocenteController::quantas_disciplinas_ano($request->id_docente, $request->ano) >=6)
            {
                return response()->json(['response' => "O Tutor já excedeu as disciplinas que pode dar", 'status'=>0]);
            }
            
            
            //return response()->json(['response' => DocenteController::quantas_disciplinas_semestre($request->id_docente, $request->codigo_disciplina, $request->ano), 'status'=>0]);
            if(DocenteController::quantas_disciplinas_semestre($request->id_docente, $request->codigo_disciplina, $request->ano) >=3 ){
                return response()->json(['response' => "O Tutor já excedeu as disciplinas para este semestre", 'status'=>0]);
            }
            
            if(DocenteController::check_if_alocada($request->codigo_disciplina, $request->ano)){
                return response()->json(['response' => "Disciplina já foi alocada para o ano de ".$request->ano."", 'status'=>0]);
            }
            
            $area = Disciplina::where('codigo_disciplina', $request->codigo_disciplina)->first();
            //return response()->json(['response' => $area]);

            $leciona = new Leciona;
            $leciona->id_docente_in_leciona = $request->id_docente;
            $leciona->id_curso_in_leciona = $request->id_curso;
            $leciona->codigo_disciplina_in_leciona = $request->codigo_disciplina;
            $leciona->id_tipo_contrato_in_leciona = 1;
            $leciona->ano_contrato = $request->ano;
            $leciona->cod_area_in_leciona = $area->cod_area_in_disciplina;
            $leciona->save();
    
            $novo_registo = Leciona::select('*')
            ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
            ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
            ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
            ->where('lecionas.ano_contrato', '=', $request->ano) // Changed "ano" to "ano_contrato"
            ->where('lecionas.id_docente_in_leciona', '=', $request->id_docente)
            ->where('lecionas.id_curso_in_leciona', '=', $request->id_curso)
            ->where('lecionas.codigo_disciplina_in_leciona', '=', $request->codigo_disciplina)
            ->where('lecionas.id_tipo_contrato_in_leciona', 1)
            ->get();

            //'response' => 'disciplina alocada com sucesso', 
            return response()->json(['response' => 'disciplina alocada com sucesso','novo_registo' => $novo_registo, 'status'=>1], 201);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage(), 'status'=>0]);
        }
    }


    public function get_disciplinas(Request $request)
    {
        try {
            $ano = ano_contrato::latest()->first()->ano_contrato;
            //return response()->json(["response"=>$request->all()]);
            if($request->has('ano')){
                $ano = $request->ano;
            }
            //$lastRow = ano_contrato::latest()->first();
            //return response()->json(["response"=>$lastRow]);

                $disciplinas = Leciona::select("*")
                    ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                    ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                    ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                    ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                    ->where('lecionas.id_docente_in_leciona', $request->id_docente)
                    ->where('docentes.id_docente', $request->id_docente)
                    ->where('lecionas.id_tipo_contrato_in_leciona', 1)
                    ->where('lecionas.ano_contrato', $ano)
                    ->get();

            return response()->json(['response' => $disciplinas], 201);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
        
    
    }

    public function get_docentes_sem_contrato(Request $request){
        $notInSubquery = DB::table('docentes')
        ->select('docentes.id_docente')
        ->join('contratos', 'docentes.id_docente', '=', 'contratos.id_docente_in_contrato')
        ->where('contratos.ano_contrato', '=', $request->ano);

        $result = Docente::whereNotIn('id_docente', $notInSubquery)->get();
        return response()->json($result);
    }

  

    public function get_all_disciplinas(Request $request){
        try {
            //return response()->json($request->all());
            $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->leftJoin('lecionado_ems', function ($join) {
                    $join->on('lecionado_ems.id_curso', '=', 'lecionas.id_curso_in_leciona')
                        ->on('lecionado_ems.codigo_disciplina', '=', 'lecionas.codigo_disciplina_in_leciona');
                })
                ->where('lecionas.id_docente_in_leciona', $request->id_docente)
                ->where('docentes.id_docente', $request->id_docente)
                
                ->get();

                
            return response()->json(['response' => $disciplinas], 201);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
    }
}
