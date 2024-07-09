<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Leciona;
use Illuminate\Support\Facades\DB;

class DisciplinaController extends Controller
{
    public function register_form()
    {
        $categoria = Categoria::all();
        $cursos = Curso::all();
        return view('disciplina.reg_form' , ['categorias'=>$categoria, 'cursos'=>$cursos]);
    }

    public function save(Request $data)
    {
        /*$data->validate([
            'codigo_disciplina' => ['string', 'required', Rule::exists('codigo_disciplina', 'disciplinas')],
            'nome_disciplina' => ['string', 'required', Rule::exists('codigo_disciplina', 'disciplinas')],
        ]);
*/
        //return response()->json($data);
        $disciplina = new Disciplina;
        $disciplina->codigo_disciplina = $data->input('codigo_disciplina');
        $disciplina->nome_disciplina = $data->input('nome_disciplina');
        $disciplina->id_cat_disciplina = $data->input('id_categoria');
        $disciplina->sigla_disciplina = $data->input('sigla');
        $disciplina->id_curso_in_disciplina = $data->input('id_curso');
        $disciplina->ano = $data->input('ano_curso');
        $disciplina->semestre = $data->input('semestre_curso');
        $disciplina->horas_contacto = $data->input('horas_c');
        $disciplina->save();

        return response()->json(['response' => 'Disciplina Registada com sucesso']);
    }

    public function get_disciplinas_only(){
        $disciplina = Disciplina::select('*')
            ->join('categorias', 'categorias.id_cat_disciplina', '=', 'disciplinas.id_cat_disciplina')->get();
            return response()->json($disciplina);
    }
    public function get_all(Request $request) {
        $curso = Curso::select('designacao_curso')->where('id_curso', $request->id_curso)->first();
        $disciplina = Disciplina::select('*') 
            ->join('cursos', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
            ->join('categorias', 'categorias.id_cat_disciplina', '=', 'disciplinas.id_cat_disciplina')
            ->where('cursos.id_curso', $request->id_curso)
            ->orderByDesc('ano')
            ->get();
    
       return view('disciplina.vizualisar', ['disciplinas' => $disciplina, 'curso'=>$curso])->render();
        //return response()->json($disciplina);
    }

    public function get_discplinas_json() {
        $disciplina = Disciplina::select('*')
            ->join('categorias', 'categorias.id_cat_disciplina', '=', 'disciplinas.id_cat_disciplina')
            ->join('lecionado_ems', 'lecionado_ems.codigo_disciplina', '=', 'disciplinas.codigo_disciplina')
            ->get();
       //return view('disciplina.vizualisar', ['disciplinas' => $disciplina])->render();
        return response()->json($disciplina);
    }

    public function get_disciplinas_curso(Request $request) {
        $curso = Curso::select('designacao_curso')->where('id_curso', $request->id_curso)->first();
        $disciplinas = Disciplina::select('*') 
            ->join('cursos', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
            ->join('categorias', 'categorias.id_cat_disciplina', '=', 'disciplinas.id_cat_disciplina')
            ->where('cursos.id_curso', $request->id_curso)
            ->orderByDesc('ano')
            ->get();
            return response()->json($disciplinas);
    }

    public function associar_form(){
        return view('disciplina.associar_com_curso');
    }

    public function associar_ao_curso(Request $request)
    {
//        return response()->json(['response' => $request->all()]);

        try{
        $disciplina_lecionada_em = new Lecionado_em;
        $disciplina_lecionada_em->id_curso = $request->id_curso;
        $disciplina_lecionada_em->codigo_disciplina = $request->codigo_disciplina;
        $disciplina_lecionada_em->ano = $request->ano;
        $disciplina_lecionada_em->semestre = $request->semestre;
        $disciplina_lecionada_em->horas_contacto = $request->horas_c;
        $disciplina_lecionada_em->save();
        return response()->json(['response' => 'Disciplina associada com sucesso'], 201);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
    }

    public function check_if_alocada(Request $request){
        $exists = Leciona::select('codigo_disciplina')
        ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
        ->where('lecionas.ano_contrato', $request->ano)
        ->where('disciplinas.codigo_disciplina', $request->codigo_disciplina)
        ->exists();

    if ($exists) {
        return response()->json(['message' => 'Sucesso: Registro encontrado.', 'response'=>1], 200); // Status 200 indica sucesso
    } else {
        return response()->json(['message' => 'Erro: Registro não encontrado.', 'response'=>2], 404); // Status 404 indica que o registro não foi encontrado
    }

    }
}
