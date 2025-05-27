<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Models\Representante;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class RepresentanteController extends Controller
{
    public function register_form(){
        $niveis = Nivel::all();
        return view('representante.reg_form', ['niveis'=>$niveis]);
    }

    
    public function save(Request $data)
    {
        try {
            // Regras de validação
            $rules = [
                'nome_representante' => 'required|string|max:255',
                'apelido_representante' => 'required|string|max:255',
                'genero_representante' => 'required|string|in:Masculino,Feminino,Outro',
                'id_nivel_contrantante' => 'required|exists:nivels,id_nivel',
            ];

            // Mensagens de erro personalizadas
            $messages = [
                'nome_representante.required' => 'Informe o nome do representante.',
                'apelido_representante.required' => 'Informe o apelido do representante.',
                'genero_representante.required' => 'Informe o gênero do representante.',
                'genero_representante.in' => 'O gênero deve ser Masculino, Feminino ou Outro.',
                'id_nivel_contrantante.required' => 'Informe o nível do contratante.',
                'id_nivel_contrantante.exists' => 'O nível do contratante informado não existe.',
            ];

            // Validação dos dados
            $validator = Validator::make($data->all(), $rules, $messages);

            // Verifica se a validação falhou
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            // Salva os dados no banco de dados
            $representante = new Representante();
            $representante->nome_representante = $data->nome_representante;
            $representante->apelido_representante = $data->apelido_representante;
            $representante->genero_representante = $data->genero_representante;
            $representante->id_nivel_contrantante = $data->id_nivel_contrantante;
            $representante->save();

            return response()->json(['success' => 'Representante cadastrado com sucesso!']);
        } catch (\Exception $e) {
            Log::info("request data", ['response' => $user->$e->getMessage()]);
            return response()->json(['error' => 'Erro ao cadastrar o representante: ' . $e->getMessage()]);
        }

      
    }
    public function get_all()
    {
        try {
            $representantes = DB::table('representantes')
                ->join('nivels', 'representantes.id_nivel_contrantante', '=', 'nivels.id_nivel')
                ->select('representantes.*', 'nivels.designacao_nivel')
                ->get();

            return response()->json($representantes);
        } catch (\Exception $e) {
            Log::info("request data", ['response' => $e->getMessage()]);
            return response()->json(['error' => 'Erro ao obter os representantes: ' . $e->getMessage()]);
        }
    }
    public function get_representante($id)
    {
        try {
            $representante = DB::table('representantes')
                ->join('nivels', 'representantes.id_nivel_contrantante', '=', 'nivels.id_nivel')
                ->select('representantes.*', 'nivels.designacao_nivel')
                ->where('representantes.id_representante', $id)
                ->get()->first();

            return response()->json($representante);
        } catch (\Exception $e) {
            Log::info("request data", ['response' => $e->getMessage()]);
            return response()->json(['error' => 'Erro ao obter o representante: ' . $e->getMessage()]);
        }
    }

    public function update(Request $data, $id)
    {
        try {
            // Regras de validação
            $rules = [
                'nome_representante' => 'required|string|max:255',
                'apelido_representante' => 'required|string|max:255',
                'genero_representante' => 'required|string|in:Masculino,Feminino,Outro',
                'id_nivel_contrantante' => 'required|exists:nivels,id_nivel',
            ];    

        }catch (\Exception $e) {
            Log::info("request data", ['response' => $e->getMessage()]);
            return response()->json(['error' => 'Erro ao atualizar o representante: ' . $e->getMessage()]);
        }
    }
    
    public function alterar_representante(Request $data, $id)
    {

        //return response()->json($data->all());
        try {
            // Validação simples (opcional)
            $representante = \App\Models\Representante::find($id);
            if (!$representante) {
                return response()->json(['error' => 'Representante não encontrado.'], 404);
            }

            // Busca o registro atual de representante ativo
            $ativo = \DB::table('table_representante_ativo')->first();

            if ($ativo) {
                // Atualiza o representante ativo existente
                \DB::table('table_representante_ativo')
                    ->where('id_representante_ativo', 1)
                    ->update([
                        'id_representante' => $data->id_representante,
                        'updated_at' => now()
                    ]);
            } else {
                // Cria um novo registro se não existir
                \DB::table('table_representante_ativo')->insert([
                    'id_representante' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return response()->json(['success' => 'Representante ativo alterado com sucesso!']);
        } catch (\Exception $e) {
            Log::info("request data", ['response' => $e->getMessage()]);
            return response()->json(['error' => 'Erro ao atualizar o representante: ' . $e->getMessage()]);
        }
    }
    public function get_representanteAtivo()
    {
        try {
            $representantes = DB::table('table_representante_ativo')
                ->join('representantes', 'table_representante_ativo.id_representante', '=', 'representantes.id_representante')
                ->select('*')
                ->get()->first();

            return response()->json($representantes);
        } catch (\Exception $e) {
            Log::info("request data", ['response' => $e->getMessage()]);
            return response()->json(['error' => 'Erro ao obter os representantes ativos: ' . $e->getMessage()]);
        }
    }
}
