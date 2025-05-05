<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Docente;
use App\Models\Leciona;
use App\Models\ficheiro;
use App\Models\ano_contrato;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


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
            $contrato->estado = "Na Up";
            $contrato->resultado_ta = "Pendente";
            $contrato->save();
            
        return response()->json(['response' => 'Contrato Registado com sucesso', 'status'=>"success"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
            //\Log::error($e->getMessage());
            //return response()->json(['response' => "O contrato já existe", 'status'=>"error"]);
        }

    }
    public function upload(Request $request) {
        try {
            if ($request->hasFile('ficheiro')) {
                $file = $request->file('ficheiro');
                $path = $file->store('uploads'); // Armazena o arquivo na pasta 'uploads'
    
                $ficheiro = new ficheiro;
                $ficheiro->id_docente_in_ficheiro = $request->id;
                $ficheiro->ano_in_ficheiro = $request->ano;
                $ficheiro->path = $path;
                $ficheiro->save();
    
                $user = Auth::user();
                Log::info("request data", ['response' => $user->id]);
    
                // Redireciona para a rota 'detalhes' com os parâmetros necessários
                return redirect()->route('detalhes', ['ano' => $request->ano, 'id_docente' => $request->id])
                    ->with('success', 'Arquivo enviado com sucesso!');
            } else {
                return redirect()->back()->withErrors(['ficheiro' => 'Arquivo não enviado.']);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } 
    
    public function downloadFicheiroPorDocenteEAno($ano, $id_docente)
    {
        try {

    
            // Busca o ficheiro com base no docente e no ano
            $ficheiro = ficheiro::where('id_docente_in_ficheiro', $id_docente)
                                ->where('ano_in_ficheiro', $ano)
                                ->first();
            Log::info("request data", ['response'=>$ficheiro]);
            if (!$ficheiro) {
                return response()->json(['error' => 'Ficheiro não encontrado para este docente e ano.'], 404);
            }
    
            if (!Storage::exists($ficheiro->path)) {
                return response()->json(['error' => 'Arquivo não existe no armazenamento.'], 404);
            }
    
            // Faz o download do ficheiro
            return Storage::download($ficheiro->path, basename($ficheiro->path));
    
        } catch (\Exception $e) {
            \Log::error("Erro ao baixar o ficheiro: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao tentar baixar o ficheiro.'], 500);
        }
    }
    

    public function teste(Request $request){
    $resp = ContratoController::check_if_alocada($request->tipo_contrato, $request->id_docente);
    return response()->json($resp);
    }

    public function set_enviados_ta(Request $request){
        try {
            Log::info("request data", ['response'=>$request->all()]);
            $affected = DB::table('contratos')
              ->where('ano_contrato', $request->ano_contrato)
              ->update([
                  'estado' => 'No TA',
                  'data_chegada_no_ta' => $request->data
              ]);
        
            return response()->json(["response" => "Atualizado com sucesso"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }
    }

    public function aprovar(Request $request){
        try {
            Log::info("request data", ['response'=>$request->all()]);
            $affected = DB::table('contratos')
              ->where('ano_contrato', $request->ano_contrato)
              ->where('id_docente_in_contrato', $request->id_docente)
              ->update([
                  'resultado_ta' => 'Aprovado',
              ]);
        
            return response()->json(["response" => "Atualizado com sucesso (Contrato Aprovado)"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }
    }

    public function reprovar(Request $request){
        try {
            Log::info("request data", ['response'=>$request->all()]);
            $affected = DB::table('contratos')
              ->where('ano_contrato', $request->ano_contrato)
              ->where('id_docente_in_contrato', $request->id_docente)
              ->update([
                  'resultado_ta' => 'Reprovado',
              ]);
        
            return response()->json(["response" => "Atualizado com sucesso (Reprovado)"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }
    }
    

    public function ver()
    {
        $anos = ano_contrato::select('*')->get();
        $contratos = Contrato::select('*')
        ->join('docentes', 'docentes.id_docente', '=', 'id_docente_in_contrato')
        ->join('tipo_contratos', 'contratos.id_tipo_contrato_in_contrato', '=', 'tipo_contratos.id_tipo_contrato')
        ->get();
        return view('contrato.ver', ['contratos'=>$contratos, 'anos'=>$anos]);
       // return response()->json($contratos);
    }

    public function detalhes($ano=null, $id_docente=null){
        $docente = Docente::select('*')
        ->join('nivels', 'nivels.id_nivel', '=', 'docentes.id_nivel')
        ->join('faculdades', 'faculdades.id_faculdade', '=', 'docentes.id_faculdade_in_docente')
        ->where('id_docente', $id_docente)
        ->first();
        $disciplinas = ContratoController::disciplinas($ano, $id_docente);
        $contrato = contrato::select('*')->where('ano_contrato', $ano)->where('id_docente_in_contrato', $id_docente)->get()->first();
        return view('contrato.detalhes', ['docente' => $docente,  'contrato'=>$contrato, 'disciplinas'=>$disciplinas])->render();
    }

    public function ver_contratos_no_ta2($ano = null)
    {

        Log::info("request data", ['response'=>$ano]);
        $contratos = Contrato::select('*')
        ->join('docentes', 'docentes.id_docente', '=', 'id_docente_in_contrato')
        ->join('tipo_contratos', 'contratos.id_tipo_contrato_in_contrato', '=', 'tipo_contratos.id_tipo_contrato')
        ->where('ano_contrato', $ano)
        ->where('estado', 'No Ta')
        ->get();
        return view('contrato.no_ta', ['contratos'=>$contratos]);
       // return response()->json($contratos);
    }

    public function ver_contratos_no_ta()
    {

        Log::info("request data", ['response'=>date('Y')]);
        $contratos = Contrato::select('*')
        ->join('docentes', 'docentes.id_docente', '=', 'id_docente_in_contrato')
        ->join('tipo_contratos', 'contratos.id_tipo_contrato_in_contrato', '=', 'tipo_contratos.id_tipo_contrato')
        ->where('ano_contrato', date('Y'))
        ->where('estado', 'No Ta')
        ->get();
        return view('contrato.no_ta', ['contratos'=>$contratos]);
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
    public static function getContratosDocente(){
        $user = Auth::user();
         Log::info("request data", ['response'=>$user->id]);
        if($user->tipo_user==3){
            $contratos = Contrato::select("*")
            ->join('docentes', 'docentes.id_docente', '=', 'id_docente_in_contrato')
            ->join('tipo_contratos', 'contratos.id_tipo_contrato_in_contrato', '=', 'tipo_contratos.id_tipo_contrato')
            ->where('id_user', $user->id)->get();
            Log::info("Número de contratos encontrados", ['count' => $contratos->count()]);
            return view('docente.ver', ['contratos'=>$contratos, 'count'=>$contratos->count(), 'ficheiro_enviado'=>'Anexo do contrato carregado com sucesso']);
        }else{
            return view('error');
        }

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


    private static function disciplinas($ano, $id_docente){
        $disciplinas = Leciona::select("*")
        ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
        ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
        ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
        ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
        ->where('lecionas.id_docente_in_leciona', $id_docente)
        ->where('docentes.id_docente', $id_docente)
        ->where('lecionas.ano_contrato', $ano)
        //  ->where('lecionas.id_tipo_contrato_in_leciona', $request->tipo_contrato)
        ->get();
        return $disciplinas;
    }


    public function get_disciplinas_contrato($ano = null, $id_docente)
    {
        try {
            $docente = ContratoController::getDocente($id_docente);

            $disciplinas = ContratoController::disciplinas($ano, $id_docente);
                
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
