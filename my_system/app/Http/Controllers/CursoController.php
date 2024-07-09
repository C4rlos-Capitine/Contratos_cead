<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso; // Change 'app\Models' to 'App\Models'
use App\Models\Categoria;
use App\Models\Disciplina;
use App\Models\Faculdade;
use App\Models\Lecionado_em;
use App\Models\Docente;
use App\Models\Centro_recurso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class CursoController extends Controller
{
    public function register_form()
    {
        $faculdades = Faculdade::all();
       // $centros = Centro_recurso::all();
        return view('curso.reg_form', ['faculdades'=>$faculdades]);
    }

    public function save(Request $data)
    {
        try {
            // Definição das regras de validação
            $rules = [
                'designacao_curso' => 'required|string|unique:cursos',
                'sigla' => 'required|string'
            ];

            // Definição das mensagens de erro
            $messages = [
                'designacao_curso.required' => 'Campo da designação de curso não preenchido',
                'designacao_curso.unique' => 'Um curso com este nome já existe',
                'sigla.required' => 'Escreva a sigla'
            ];

            if ($data->has('faculdade')) {
                // Se estiver presente, adiciona a regra de validação para 'faculdade'
                $rules['faculdade'] = 'required';
                $messages['faculdade.required'] = 'Selecione a Faculdade';
            }
            //return response()->json(['response' => $data->all()]);
            // Criação do objeto Validator
            $validator = Validator::make($data->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['response' => 'Erro de validação', 'errors' => $validator->errors()]);
            }
     
            $curso = new Curso;
            $curso->designacao_curso = $data->input('designacao_curso');
            $curso->sigla_curso = $data->input('sigla');
            $curso->id_faculdade_in_curso = $data->input('faculdade');
            $curso->id_docente_dir_curso = $data->input('dir_curso');
            $curso->save();

            return response()->json(['response' => 'Curso Registado com sucesso']);
        } catch (\Exception $e) {
            // Retorno de erro em caso de exceção
            return response()->json(['response' => $e->getMessage()]);
        }
    }

    public function get_all() {
        $cursos = Curso::select('*')
            ->join('faculdades', 'faculdades.id_faculdade', '=', 'cursos.id_faculdade_in_curso')->get();
        $htmlSnippet = view('curso.vizualisar', ['cursos' => $cursos])->render();
        return $htmlSnippet;
    }

    public function get_by_json(){
        $cursos = Curso::select('*')
        ->join('faculdades', 'faculdades.id_faculdade', '=', 'cursos.id_faculdade_in_curso')->get();
        return response()->json($cursos);
    }

    public function ver_detalhes(Request $request)
    {
        $cursos = Curso::select('*')
        ->join('faculdades', 'faculdades.id_faculdade', '=', 'cursos.id_faculdade_in_curso')
        
        ->where("id_curso", $request->id_curso)->first();
        $docente = Docente::select("*")->where("id_docente", $cursos->id_docente_dir_curso)->first();
        $docentes = Docente::select("*")->where("id_faculdade_in_docente", $docente->id_faculdade_in_docente)->get();
      
        return view('curso.detalhes', ['cursos'=>$cursos, 'docente'=>$docente, 'docentes'=>$docentes]);
    }

    public function update(Curso $curso)
    {
        try {
            $data = request()->validate([
                'designacao_curso' => 'required|unique:cursos,designacao_curso'
            ]);

            // Return request values for debugging
            return response()->json(['response' => $data]);

            $curso->update($data);
            return response()->json(["response" => "Atualizado com sucesso"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }
    }



    public function get_disciplinas_byano(Request $request)
    {
        //return $request->all();
        if($request->tipo_contrato == 1){
            $disciplinas = Lecionado_em::select("*")
            ->join('cursos', 'lecionado_ems.id_curso', '=', 'cursos.id_curso')
            ->join('disciplinas', 'lecionado_ems.codigo_disciplina', '=', 'disciplinas.codigo_disciplina')
            ->where('lecionado_ems.id_curso', '=', intval($request->id_curso))
            ->where('lecionado_ems.ano', '=', intval($request->ano))
            ->where('lecionado_ems.semestre', '=', intval($request->semestre))
            ->where('disciplinas.id_cat_disciplina', '!=', 3)
            ->get();
            return response()->json($disciplinas);
        }else{
            $disciplinas = Lecionado_em::select("*")
            ->join('cursos', 'lecionado_ems.id_curso', '=', 'cursos.id_curso')
            ->join('disciplinas', 'lecionado_ems.codigo_disciplina', '=', 'disciplinas.codigo_disciplina')
            ->where('lecionado_ems.id_curso', '=', intval($request->id_curso))
            ->where('lecionado_ems.ano', '=', intval($request->ano))
            ->where('lecionado_ems.semestre', '=', intval($request->semestre))
            ->where('disciplinas.id_cat_disciplina', '=', 3)
            ->get();
            return response()->json($disciplinas);
        }
        
    }

    public function disciplinas_nao_associada(Request $request){
        //return response()->json($request->all());
        $operador = "=";
        if($request->tipo_contrato == 1){
            $operador = "!=";
        }
        $result = Disciplina::select('disciplinas.*')
        ->join('cursos', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
        ->where('cursos.id_curso', $request->id_curso)
        ->where('disciplinas.semestre', $request->semestre)
        ->where('disciplinas.ano', $request->ano)
        ->whereNotIn('disciplinas.codigo_disciplina', function ($query) use ($request) {
            $query->select('d.codigo_disciplina')
                ->from('lecionas')
                ->join('disciplinas as d', 'lecionas.codigo_disciplina_in_leciona', '=', 'd.codigo_disciplina')
                ->where('lecionas.id_curso_in_leciona', $request->id_curso)
                ->where('disciplinas.semestre', $request->semestre)
                ->where('lecionas.ano_contrato', $request->ano_contrato)
                ->where('disciplinas.ano', $request->ano);
        })
        ->get();
    return response()->json($result);
    }  

    public function disciplinas_todas_disci_nao_asso(Request $request){
        $result = Disciplina::select('disciplinas.*')
        ->join('cursos', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
        ->where('cursos.id_curso', $request->id_curso)
        //->where('lecionas.ano_contrato', $request->ano_contrato)
        ->whereNotIn('disciplinas.codigo_disciplina', function ($query) use ($request) {
            $query->select('d.codigo_disciplina')
                ->from('lecionas')
                ->join('disciplinas as d', 'lecionas.codigo_disciplina_in_leciona', '=', 'd.codigo_disciplina')
                ->where('lecionas.id_curso_in_leciona', $request->id_curso)
                ->where('lecionas.ano_contrato', $request->ano_contrato);
        })
        ->get();
    return response()->json(["disciplinas"=>$result]);
    }
    
    public function get_count_disciplinas_associadas(){
        $cursos = Curso::all();
        $totalDisciplinas = 0;
        $cursosCount = $cursos->count();
        $cada_curso = [];

        foreach ($cursos as $curso) {
            //$count = DB::table('disciplinas')
            $count = Disciplina::join('cursos', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
            ->where('cursos.id_curso', $curso->id_curso)
            ->whereIn('disciplinas.codigo_disciplina', function ($query) use ($curso) {
                $query->select('disciplinas.codigo_disciplina')
                    ->from('lecionas')
                    ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                    ->where('lecionas.id_curso_in_leciona', $curso->id_curso)
                    ->where('lecionas.ano_contrato', date("Y"));
            })
            ->count();
                
                $countLecionadoEmsCurso2 = DB::table('cursos')
                ->join('disciplinas', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
                ->where('cursos.id_curso', $curso->id_curso)
                ->count();
                
                $cada_curso[] = [
                    'id_curso' => $curso->id_curso,
                    'designacao_curso' => $curso->designacao_curso,
                    'nao_associadas' => $count,
                    'total_disciplinas' => $countLecionadoEmsCurso2,
                ];

            $totalDisciplinas += $count;
        }

        //return response()->json(['curso' => $cursos, 'total_cursos' => $cursosCount, 'cada_curso' => $cada_curso]);
        return $htmlSnippet = view('estatisticas', ['curso' => $cursos, 'total_cursos' => $cursosCount, 'cada_curso' => $cada_curso])->render();
       // echo "Total Disciplinas: " . $totalDisciplinas;
        //echo "Total Cursos: " . $cursosCount; // Display the total number of cursos
        

    }

    public function check_disciplinas_in_contrato(Request $request)
    {
        $registos = Leciona::select('*')
            //->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
            ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
            ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
            ->where('lecionas.ano_contrato', '=', date('Y')) // Changed "ano" to "ano_contrato"
            //->where('lecionas.id_docente_in_leciona', '=', $request->id_docente)
            ->where('lecionas.id_curso_in_leciona', '=', $request->id_curso)
            ->where('lecionas.codigo_disciplina_in_leciona', '=', $request->codigo_disciplina)
            //->where('lecionas.id_tipo_contrato_in_leciona', $request->tipo_contrato)
            ->get();

        // Count the number of records
        return $registos->count();
        //echo "Number of records: " . $numberOfRecords;

    }
    
}
