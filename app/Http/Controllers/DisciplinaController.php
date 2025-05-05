<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Leciona;
use App\Models\Area_cientifica;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DisciplinaController extends Controller
{
    public function register_form()
    {
        $categoria = Categoria::all();
        $cursos = Curso::all();
        $area_cientifica = Area_cientifica::all();
        return view('disciplina.reg_form' , ['categorias'=>$categoria, 'cursos'=>$cursos, 'areas'=>$area_cientifica]);
    }

    public function save(Request $data)
    {
        //return response()->json(['response'=>$data->all()]);
        try{
           // \Log::info('Valores recebidos para exclusão:', $data->all());
        $rules = [
            'codigo_disciplina' => 'required',
            'codigo_disciplina' => 'unique:disciplinas,codigo_disciplina',
            'nome_disciplina' => 'required',
            'id_categoria' => 'required',
            'sigla'=>'required',
            'id_curso'=>'required',
            'horas_c'=>'required',
            'cod_area'=>'required',
            'ano_curso'=>'required',
            'semestre_curso'=>'required'
            // Add other validation rules as needed
        ];

         // Custom error messages
         $messages = [
           'codigo_disciplina.required' => 'Informe o código da disciplina',
           'codigo_disciplina.unique' => 'O Código já existe',
           'nome_disciplina.required' => 'Informe o Nome da Disciplina',
           'id_categoria.required' => 'Selecione a Categoria da disciplina',
           'sigla.required' => 'Informe a Sigla',
           'id_curso.required'=>'Selecione o Curso',
           'ano_curso.required' => 'Informe o ano em que a disciplina será lecionada',
           'horas_c.required'=>'Selecione as horas de contacto',
           'cod_area.required'=>'Selecione a área cientifica',
           'semestre_curso.required'=>'Selecione o semestre'
            // Add other custom error messages as needed
        ];

        $validator = Validator::make($data->all(), $rules, $messages);
        
        // Check if validation fails

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status'=>0]);
        }



        $count = Disciplina::where('id_curso_in_disciplina', $data->input('id_curso'))
        ->where('semestre', $data->input('semestre_curso'))
        ->where('ano', $data->input('ano_curso'))
        ->count('codigo_disciplina');

        if($count>=6){
            $erros = [
                'Erro relacionado ao Número máximo de disciplinas',
                'O semestre '.$data->input('semestre_curso').' do ano '.$data->input('ano_curso') .' já tem 6 disciplinas',
                
            ];
            return response()->json(['errors' => $erros, 'status'=>0]);
        }


        $disciplina = new Disciplina;
        $disciplina->codigo_disciplina = $data->input('codigo_disciplina');
        $disciplina->nome_disciplina = $data->input('nome_disciplina');
        $disciplina->id_cat_disciplina = $data->input('id_categoria');
        $disciplina->sigla_disciplina = $data->input('sigla');
        $disciplina->id_curso_in_disciplina = $data->input('id_curso');
        $disciplina->ano = $data->input('ano_curso');
        $disciplina->semestre = $data->input('semestre_curso');
        $disciplina->horas_contacto = $data->input('horas_c');
        $disciplina->cod_area_in_disciplina = $data->input('cod_area');
        $disciplina->save();

        $resp = "Disciplina de" . $data->input('nome_disciplina') . "Registada com sucesso no curso de ";

        return response()->json(['response' => $resp, 'status'=>1]);
        }catch(\Exception $e){
            //\Log::info('Exceção capturada', ['mensagem' => $e->getMessage()]);

            return response()->json(['response' => $e->getMessage(), 'status'=>0], 500);   
        }
    }

    public function get_disciplinas_only(){
        $disciplina = Disciplina::select('*')
            ->join('categorias', 'categorias.id_cat_disciplina', '=', 'disciplinas.id_cat_disciplina')->get();
            return response()->json($disciplina);
    }
    public function get_all($id_curso = null) {
        $curso = Curso::select('designacao_curso')->where('id_curso', $id_curso)->first();
        $disciplina = Disciplina::select('*') 
            ->join('cursos', 'cursos.id_curso', '=', 'disciplinas.id_curso_in_disciplina')
            ->join('categorias', 'categorias.id_cat_disciplina', '=', 'disciplinas.id_cat_disciplina')
            ->where('cursos.id_curso', $id_curso)
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

    public function get_by_categoria(Request $request)
    {
        $disciplinas = Disciplina::select('*') 
            ->join('cursos', 'disciplinas.id_curso_in_disciplina', '=', 'cursos.id_curso')
            ->where('id_curso', $request->id_curso)
            ->where('id_cat_disciplina', $request->id_cat)
            ->get();
            return response()->json(['disciplinas'=>$disciplinas]);
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
