<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculdade;
use App\Models\Docente;
use Illuminate\Support\Facades\Validator;
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
    
}
