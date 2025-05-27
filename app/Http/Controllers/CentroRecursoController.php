<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Centro_recurso;
use Illuminate\Support\Facades\Validator;

class CentroRecursoController extends Controller
{

    public function register_form(){
        return view('centro_recurso.reg_form');
    }

    public function save(Request $data)
    {
        try {
            // Regras de validação
            $rules = [
                'nome_centro' => 'required|string|max:255',
            ];

            // Mensagens de erro personalizadas
            $messages = [
                'nome_centro.required' => 'Informe o nome do centro de recursos.',
                'nome_centro.string' => 'O nome do centro de recursos deve ser uma string.',
                'nome_centro.max' => 'O nome do centro de recursos não pode ter mais de 255 caracteres.',
            ];

            // Validação dos dados
            $validator = Validator::make($data->all(), $rules, $messages);

            // Verifica se a validação falhou
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            // Salva os dados no banco de dados
            $centroRecurso = new Centro_recurso();
            $centroRecurso->nome_centro = $data->nome_centro;
            $centroRecurso->save();

            return response()->json(['success' => 'Centro de recursos cadastrado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar o centro de recursos: ' . $e->getMessage()]);
        }
    }
    public function list()
    {
        $centros = Centro_recurso::all();
        return view('centro_recurso.list', ['centros' => $centros]);
    }
    public function delete($id)
    {
        try {
            $centro = Centro_recurso::findOrFail($id);
            $centro->delete();
            return response()->json(['success' => 'Centro de recursos excluído com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o centro de recursos: ' . $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        try {
            $centro = Centro_recurso::findOrFail($id);
            return response()->json(['centro' => $centro]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar o centro de recursos: ' . $e->getMessage()]);
        }
    }
    public function update(Request $data, $id)
    {
        try {
            // Regras de validação
            $rules = [
                'nome_centro' => 'required|string|max:255',
            ];

            // Mensagens de erro personalizadas
            $messages = [
                'nome_centro.required' => 'Informe o nome do centro de recursos.',
                'nome_centro.string' => 'O nome do centro de recursos deve ser uma string.',
                'nome_centro.max' => 'O nome do centro de recursos não pode ter mais de 255 caracteres.',
            ];

            // Validação dos dados
            $validator = Validator::make($data->all(), $rules, $messages);

            // Verifica se a validação falhou
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            // Atualiza os dados no banco de dados
            $centroRecurso = Centro_recurso::findOrFail($id);
            $centroRecurso->nome_centro = $data->nome_centro;
            $centroRecurso->save();

            return response()->json(['success' => 'Centro de recursos atualizado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o centro de recursos: ' . $e->getMessage()]);
        }
    }
    public function get_all()
    {
        try {
            $centros = Centro_recurso::all();
            return response()->json($centros);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar os centros de recursos: ' . $e->getMessage()]);
        }
    }
    public function get_by_id($id)
    {
        try {
            $centro = Centro_recurso::findOrFail($id);
            return response()->json($centro);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar o centro de recursos: ' . $e->getMessage()]);
        }
    }
    public function get_by_name($name)
    {
        try {
            $centro = Centro_recurso::where('nome_centro', 'like', '%' . $name . '%')->get();
            return response()->json($centro);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar o centro de recursos: ' . $e->getMessage()]);
        }
    }
    
    public function list2()
    {
        $centros = Centro_recurso::all();
        return response()->json(['centros' => $centros]);
    }

}
