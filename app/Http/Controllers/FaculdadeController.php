<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculdade;
use App\Models\Docente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class FaculdadeController extends Controller
{
    public function register_form()
    {
        return view('faculdade.reg_form');
    }

    public function save(Request $data)
    {
        try {

            //return response()->json(['response'=>$data->all()]);
            $rules = [
                'nome_faculdade' => 'required|string|unique:faculdades',
                'sigla_faculdade' => 'required|string|max:10',
            ];

            $messages = [
                "nome_faculdade.required" => "campo do nome da faculdae é obrigatório",
                "nome_faculdade.unique" => "Já existe uma faculdade com o nome",
            ];

        
            $validator = Validator::make($data->all(), $rules, $messages);
            
            if ($validator->fails()) {
                return response()->json(['response' => 'Erro de validação', 'errors' => $validator->errors()]);
            }
    
       
            $faculdade = new Faculdade;
            $faculdade->nome_faculdade = $data->input('nome_faculdade');
            $faculdade->sigla_faculdade = $data->input('sigla_faculdade');
            $faculdade->save();
           
            return response()->json(['response' => 'Faculdade registrada com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }
    }
    
    
    public function get_all() {
        try{
            $faculdade = Faculdade::all();
            return response()->json(['faculdades'=>$faculdade]);
        //return view('faculdade.vizualisar', ['faculdades' => $faculdade]);
        //return $htmlSnippet;
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }
    }

    public function get_list(){
        try{
            $faculdade = Faculdade::all();
            //return response()->json(['faculdades'=>$faculdade]);
            return view('faculdade.vizualisar', ['faculdades' => $faculdade]);
        //return $htmlSnippet;
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }
    }

    public function get_disciplinas(Request $request)
    {

    }

    public function get_docentes(Request $request)
    {
        $docentes = Docente::select("*")->where("id_faculdade_in_docente", $request->faculdade)->get();
        return response()->json(['docentes'=>$docentes]);
    }
    public function edit($id){
        $faculdade = Faculdade::find($id);
       // return response()->json(['faculdade'=>$faculdade]);
       return view('faculdade.edit', ['faculdade' => $faculdade]);
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'nome_faculdade' => 'required|string|unique:faculdades,nome_faculdade,' . $id . ',id_faculdade',
                'sigla_faculdade' => 'required|string|max:10',
            ];

            $messages = [
                "nome_faculdade.required" => "Campo do nome da faculdade é obrigatório",
                "nome_faculdade.unique" => "Já existe uma faculdade com este nome",
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['response' => 'Erro de validação', 'errors' => $validator->errors()], 422);
            }

            $faculdade = Faculdade::find($id);
            if (!$faculdade) {
                return response()->json(['response' => 'Faculdade não encontrada'], 404);
            }

            $faculdade->nome_faculdade = $request->input('nome_faculdade');
            $faculdade->sigla_faculdade = $request->input('sigla_faculdade');
            $faculdade->save();

            return response()->json(['response' => 'Faculdade editada com sucesso', 'success'=> true]);
        } catch (\Exception $e) {
            //Log::error('Error updating faculdade: ' . $e->getMessage());
            return response()->json(['response' => 'Erro ao atualizar faculdade', 'error' => $e->getMessage()], 500);
        }
    }
    public function delete($id){
        try {
            $faculdade = Faculdade::find($id);
            if ($faculdade) {
                $faculdade->delete();
                return response()->json(['response' => 'Faculdade excluída com sucesso']);
            } else {
                return response()->json(['response' => 'Faculdade não encontrada']);
            }
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
        }
    }
    
}
