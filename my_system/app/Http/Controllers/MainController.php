<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Curso; 
use App\Models\Disciplina;
use App\Models\Docente;
use App\Models\Contrato;
use Illuminate\Http\Request;

class MainController extends Controller
{
      
    public function __invoke(){
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

                $centro = DB::table('cursos')
                    ->join('centro_recursos', 'cursos.id_centro_in_curso', '=', 'centro_recursos.id_centro')
                    ->select('cursos.*', 'centro_recursos.*')
                    ->where('cursos.id_curso', $curso->id_curso)
                    ->get()->first();
                
                
                $cada_curso[] = [
                    'id_curso' => $curso->id_curso,
                    'designacao_curso' => $curso->designacao_curso,
                    'nao_associadas' => $count,
                    'total_disciplinas' => $countLecionadoEmsCurso2,
                    'nome_centro' => $centro->nome_centro,
                    'id_centro' => $centro->id_centro
                ];

            $totalDisciplinas += $count;
        }
        $total_docentes = Docente::count();
        $total_contratados = Contrato::where('ano_contrato', date('Y'))->count();
        //return response()->json(['curso' => $cursos, 'total_cursos' => $cursosCount, 'cada_curso' => $cada_curso]);
        //return $htmlSnippet = view('estatisticas', ['curso' => $cursos, 'total_cursos' => $cursosCount, 'cada_curso' => $cada_curso])->render();
    return view('welcome', ['users'=>auth()->user(), 'curso' => $cursos, 'total_cursos' => $cursosCount, 'cada_curso' => $cada_curso, 'total_docentes'=>$total_docentes, 'contratados'=> $total_contratados]);
    }



 function with_ano($ano = null){
    //return $ano;
    $cursos = Curso::all();
    $totalDisciplinas = 0;
    $cursosCount = $cursos->count();
    $cada_curso = [];

    foreach ($cursos as $curso) {
        //$count = DB::table('disciplinas')
        //echo $ano;
        $count = Disciplina::join('cursos', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
        ->where('cursos.id_curso', $curso->id_curso)
        ->whereIn('disciplinas.codigo_disciplina', function ($query) use ($curso, $ano) {
            $query->select('disciplinas.codigo_disciplina')
                ->from('lecionas')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->where('lecionas.id_curso_in_leciona', $curso->id_curso)
                ->where('lecionas.ano_contrato', $ano);
        })
        ->count();
            
            $countLecionadoEmsCurso2 = DB::table('cursos')
            ->join('disciplinas', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
            ->where('cursos.id_curso', $curso->id_curso)
            ->count();

            $centro = DB::table('cursos')
                    ->join('centro_recursos', 'cursos.id_centro_in_curso', '=', 'centro_recursos.id_centro')
                    ->select('cursos.*', 'centro_recursos.*')
                    ->where('cursos.id_curso', $curso->id_curso)
                    ->get()->first();
            
            $cada_curso[] = [
                'id_curso' => $curso->id_curso,
                'designacao_curso' => $curso->designacao_curso,
                'nao_associadas' => $count,
                'total_disciplinas' => $countLecionadoEmsCurso2,
                'nome_centro' => $centro->nome_centro,
                'id_centro' => $centro->id_centro
            ];

        $totalDisciplinas += $count;
    }
    $total_docentes = Docente::count();
    $total_contratados = Contrato::where('ano_contrato', $ano)->count();
    //return response()->json(['curso' => $cursos, 'total_cursos' => $cursosCount, 'cada_curso' => $cada_curso]);
    //return response()->json(['users'=>auth()->user(), 'curso' => $cursos, 'total_cursos' => $cursosCount, 'cada_curso' => $cada_curso, 'total_docentes'=>$total_docentes, 'contratados'=> $total_contratados, 'ano'=>$ano]);
    return view('welcome2', ['users'=>auth()->user(), 'curso' => $cursos, 'total_cursos' => $cursosCount, 'cada_curso' => $cada_curso, 'total_docentes'=>$total_docentes, 'contratados'=> $total_contratados, 'ano'=>$ano]);
    }
}
