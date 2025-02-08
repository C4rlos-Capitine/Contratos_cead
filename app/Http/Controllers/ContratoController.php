<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Docente;
use App\Models\Leciona;
use App\Models\ano_contrato;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class ContratoController extends Controller
{
    public function create(Request $request)
    {
        try{
            //return response()->json(["response"=>$request->all()]);
            if(ContratoController::check_if_alocada($request->ano, $request->id_docente)){
                return response()->json(['response' => 'Contrato já existe', 'status'=>"error"]);
            }
            $docente = ContratoController::getDocente($request->id_docente);
      
            $disciplinas = ContratoController::getDisciplinasLecionadas($request->id_docente, $request->tipo_contrato);
            
           
            $remuneracao = 0;
            $hcontacto = 0;
            foreach ($disciplinas as $disciplina) {
                $hcontacto += $disciplina->horas_contacto;
            }

            $total_ganho = $hcontacto * $docente->remuneracao_hora;            ;

            $contrato = new Contrato;
            $contrato->id_docente_in_contrato = $request->id_docente;
            $contrato->id_tipo_contrato_in_contrato = $request->tipo_contrato;
            $contrato->ano_contrato = $request->ano;
            $contrato->carga_horaria = $hcontacto;
            $contrato->remuneracao = $total_ganho;
            $contrato->assinado_docente = "Não";
            $contrato->assinado_up = "Não";
            $contrato->save();
            
        return response()->json(['response' => 'Contrato Registado com sucesso', 'status'=>"success"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
            //\Log::error($e->getMessage());
            //return response()->json(['response' => "O contrato já existe", 'status'=>"error"]);
        }

    }

    public function teste(Request $request){
    $resp = ContratoController::check_if_alocada($request->tipo_contrato, $request->id_docente);
    return response()->json($resp);
    }

    public function ver()
    {
        $contratos = Contrato::select('*')
        ->join('docentes', 'docentes.id_docente', '=', 'id_docente_in_contrato')
        ->join('tipo_contratos', 'contratos.id_tipo_contrato_in_contrato', '=', 'tipo_contratos.id_tipo_contrato')
        ->get();
        return view('contrato.ver', ['contratos'=>$contratos]);
       // return response()->json($contratos);
    }

    public static function getDocente($id_docente)
    {
        $docente = Docente::select('*')
            ->join('nivels', 'nivels.id_nivel', '=', 'docentes.id_nivel')
            ->where('id_docente', $id_docente)
            ->first();
        return $docente;
    }

    public static function getDocente2($email)
    {
        $docente = Docente::select('*')
            ->join('nivels', 'nivels.id_nivel', '=', 'docentes.id_nivel')
            ->where('email', $email)
            ->first();
        return $docente;
    }
    public static function getDisciplinasLecionadas($id_docente, $tipo_contrato)
    {
  
        //return response()->json($request->all());
        if(isset($tipo_contrato)){
            $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->where('lecionas.id_docente_in_leciona', $id_docente)
                ->where('docentes.id_docente', $id_docente)
                ->where('lecionas.id_tipo_contrato_in_leciona', $tipo_contrato)
                ->get();

            }else{
                $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->where('lecionas.id_docente_in_leciona', $id_docente)
                ->where('docentes.id_docente', $id_docente)
                
                ->get();
            }
            return $disciplinas;
    }


    public function get_disciplinas_contrato(Request $request)
    {
        try {
            //return response()->json($request->all());
            $docente = ContratoController::getDocente($request->id_docente);
            $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->where('lecionas.id_docente_in_leciona', $request->id_docente)
                ->where('docentes.id_docente', $request->id_docente)
                ->where('lecionas.ano_contrato', $request->ano)
                //  ->where('lecionas.id_tipo_contrato_in_leciona', $request->tipo_contrato)
                ->get();

                
            return view('docente.disciplinas_ver',['disciplinas' => $disciplinas, 'docente'=>$docente]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
    }
    public function disciplina_by_email(Request $request)
    {
        try {
            //return response()->json($request->all())
            $docente = ContratoController::getDocente2($request->email);
            //return response()->json($docente);
            $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->leftJoin('lecionado_ems', function ($join) {
                    $join->on('lecionado_ems.id_curso', '=', 'lecionas.id_curso_in_leciona')
                        ->on('lecionado_ems.codigo_disciplina', '=', 'lecionas.codigo_disciplina_in_leciona');
                })
                ->where('lecionas.id_docente_in_leciona',  $docente->id_docente)
                ->where('docentes.id_docente',  $docente->id_docente)
                //  ->where('lecionas.id_tipo_contrato_in_leciona', $request->tipo_contrato)
                ->get();

                
            return view('docente.disciplinas_ver',['disciplinas' => $disciplinas, 'docente'=>$docente]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
    }

    
    private function check_if_alocada($ano_contrato, $id_docente){
        return Contrato::select("id_docente_in_contrato")
            ->where('id_docente_in_contrato', $id_docente)
            ->where('ano_contrato', $ano_contrato)->exists();
    }


    public function create_contratos_para_ano(Request $request){
        try{

            $rules = [
                'ano_contrato' => 'required|unique:ano_contratos',
                
            ];

            $messages = [
                'ano_contrato.required' => 'campo do ano é obrigatorio',
                'ano_contrato.unique' => "Já existem contratos de $request->ano_novo_contrato."
            ];

        
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if ($validator->fails()) {
                return response()->json(['response' => 'Erro de validação', 'errors' => $validator->errors()]);
            }
            $contrato_novo = new ano_contrato;
        
            $contrato_novo->ano_contrato = $request->ano_contrato;
            $contrato_novo->estagio_in_ano_contrato = 1;
            $contrato_novo->save();
            return response()->json(['response' => "Contratos para o ano de $request->ano_novo_contrato ."]);
        } catch(\Exception $e) {
            return response()->json(['response' => $e->getMessage(), 'errors'=>'Erro']);
        }
    }

    public function gerar_contrato(){

        
        return view('contrato.gerar');
    }

    public function set_assinado_docente(Request $request){
        try {
            Log::info('Requisição Recebida:', $request->all()); 
            $affected = DB::table('contratos')
              ->where('id_docente_in_contrato', $request->id_docente)
              ->where('ano_contrato', $request->ano)
              ->update(['assinado_docente' => 'Sim']);
        
            return response()->json(["response" => "Contrato actualizado com sucesso"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }

    }

    public function set_assinado_up(Request $request){
        try {

            $affected = DB::table('contratos')
              ->where('id_docente_in_contrato', $request->id_docente)
              ->where('ano_contrato', $request->ano)
              ->update(['assinado_up' => 'Sim']);
        
            return response()->json(["response" => "Contrato actualizado com sucesso"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }

    }

    public function get_docentes_com_disc_aloc(Request $request)
    {
        $ano = $request->ano; // Extraia o ano do request para facilitar o uso na subconsulta.

        $docentes = Docente::whereIn('id_docente', function ($query) use ($ano) {
            $query->select('id_docente_in_leciona')
                ->from('lecionas')
                ->where('ano_contrato', $ano);
        })->select('id_docente', 'nome_docente')->get();

        return response()->json(['docentes' => $docentes]);
    }

    public function get_assinados_docentes(Request $request){
        
        $total_contratados = Contrato::where('ano_contrato', $request->ano)->count();
        $count_contratos_assinados_docentes = Contrato::where('ano_contrato', $request->ano)
                 ->where('assinado_docente', 'Sim')
                 ->count('id_docente_in_contrato');
       // $count_contratos_assiandos_up = Contrato::where('ano_contrato', $request->ano)
        //->where('assinado_up', 'Sim')
        //->count('id_docente_in_contrato'); 'asinnados_up'=>$count_contratos_assiandos_up
        $nao_asinaram = $total_contratados - $count_contratos_assinados_docentes;
        return response()->json(['total_contr'=>$total_contratados, 'docentes_assinaram'=>$count_contratos_assinados_docentes, 'nao_assinaram'=>$nao_asinaram ]);
    }

    public function get_assinados_up(Request $request){
        
        $total_contratados = Contrato::where('ano_contrato', $request->ano)->count();
        $count_contratos_assinados_docentes = Contrato::where('ano_contrato', $request->ano)
                 ->where('assinado_up', 'Sim')
                 ->count('id_docente_in_contrato');
       // $count_contratos_assiandos_up = Contrato::where('ano_contrato', $request->ano)
        //->where('assinado_up', 'Sim')
        //->count('id_docente_in_contrato'); 'asinnados_up'=>$count_contratos_assiandos_up
        $nao_asinaram = $total_contratados - $count_contratos_assinados_docentes;
        return response()->json(['total_contr'=>$total_contratados, 'assinados'=>$count_contratos_assinados_docentes, 'nao_assinaram'=>$nao_asinaram ]);
    }

    
        
    

    

}
