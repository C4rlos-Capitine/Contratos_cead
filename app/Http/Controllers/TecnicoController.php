<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tecnico;
use App\Models\Nivel;
use \App\Models\Faculdade;
use \App\Models\Curso;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TecnicoController extends Controller
{
    public function form(){
        $niveis = Nivel::all();
        $faculdades = Faculdade::all();
        $cursos = Curso::all();
        return view('tecnico_lab.register_form', ['niveis'=>$niveis, 'faculdades'=>$faculdades, 'cursos'=>$cursos]);
    }

    public function save(Request $request){
        try {
            Log::info('Requisição Recebida:', $request->all()); 
            // Validar os campos
            $rules = [
                'email' => 'required|email|unique:tecnicos,email',
                'bi' => 'required|size:13|unique:tecnicos,bi',
                'nuit' => 'required|size:8|unique:tecnicos,nuit',
                'genero'=> 'required',
                'nome_tecnico' => 'required',
                'apelido_tecnico' => 'required',
                'id_curso'=>'required'

            ];
    
            // Mensagens de erro personalizadas
            $messages = [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O email deve ser um endereço de email válido.',
                'email.unique' => 'O email já está em uso.',
                'bi.required' => 'O campo BI é obrigatório.',
                'bi.size' => 'O BI deve ter exatamente 13 caracteres.',
                'bi.unique' => 'O BI já está em uso.',
                'nuit.required' => 'O campo NUIT é obrigatório.',
                'nuit.size' => 'O NUIT deve ter exatamente 8 caracteres.',
                'nuit.unique' => 'O NUIT já está em uso.',
                'genero.required' => 'Selecione o genero',
                'nome_tecnico' => 'Informe o nome do técnico',
                'apelido_tecnico' => 'Informe o apelido',
                'id_curso' => 'Selecione o Curso'
            ];
    
            // Executar validação
            $validator = Validator::make($request->all(), $rules, $messages);
            Log::info('Validator:', ['result'=>$validator->fails()]); 
            // Checar falha de validação
            if ($validator->fails()) {
                return response()->json(['response' => 'Erro de validação', 'errors' => $validator->errors()]);
            }
    
            // Criar um novo técnico
            $tecnico = new tecnico;
            $tecnico->nome_tecnico = $request->nome_tecnico;
            $tecnico->apelido_tecnico = $request->apelido_tecnico;
            $tecnico->nuit = $request->nuit;
            $tecnico->bi = $request->bi;
            $tecnico->nacionalidade = $request->nacionalidade;
            $tecnico->id_nivel = $request->id_nivel;
            $tecnico->email = $request->email;
            $tecnico->genero = $request->genero;
            $tecnico->id_faculdade_in_tecnico = $request->id_faculdade_in_tecnico;
            $tecnico->id_curso = $request->id_curso;
            $tecnico->save();
    
            // Retornar o ID do técnico recém-criado
            return response()->json([
                "response" => "Técnico {$tecnico->nome_tecnico} registrado com sucesso",
                "id_tecnico" => $tecnico->id_tecnico
            ]);
        } catch (\Exception $e) {
            Log::error('Erro ao salvar técnico: ' . $e->getMessage());

            return response()->json(['response' => $e->getMessage()], 500);
        }
    }

    public function get_all(){
        //$tecnicos = tecnico::all();
        $tecnicos = tecnico::select('*')
        ->join('nivels', 'nivels.id_nivel', '=', 'tecnicos.id_nivel')//
        ->join('cursos', 'cursos.id_curso', '=', 'tecnicos.id_curso')//
        ->join('faculdades', 'faculdades.id_faculdade', '=', 'tecnicos.id_faculdade_in_tecnico')->get();
        return response()->json(['response'=>$tecnicos]);
    }

}
