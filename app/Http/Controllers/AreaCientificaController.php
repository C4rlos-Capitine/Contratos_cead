<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\area_cientifica;
use App\Models\Docente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AreaCientificaController extends Controller
{


    public function reg_form(){
        return view('disciplina.reg_area');
    }

    public function save(Request $request){
        try{
            $area = new area_cientifica;
            $area->cod_area = $request->cod_area;
            $area->designacao_area = $request->nome_area;
            $area->save();
            return response()->json(['response' => 'Area Registada com sucesso', 'status'=>"success"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
            //\Log::error($e->getMessage());
            //return response()->json(['response' => "O contrato já existe", 'status'=>"error"]);
        }
    }

    public function get_areas(){
        return response()->json( ['areas'=>$areas = area_cientifica::all()]);
    }

    public function get_areas2($id_docente){
        $areas = area_cientifica::select("cod_area", "designacao_area")->join('area_docente', 'cod_area', '=', 'id_area')->where('id_docente', $id_docente)->get();
        return response()->json(['areas'=>$areas]);
    }

    public function alocar_area(Request $request)
    {
        try{
            // Inserindo os dados na tabela desejada
           //return response()->json(['response'=>$request->all()]);
            DB::table('area_docente')->insert([
                'id_docente' => $request->input('id_docente'),
                'id_area' => $request->input('cod_area'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $nomeDocente = DB::table('docentes')
            ->where('id_docente', $request->input('id_docente'))
            ->value('nome_docente');

            // Retornando uma resposta de sucesso
            return response()->json(['response' => 'Área alocada com sucesso!'], 200);
        }catch (\Exception $e) {
            Log::info("Exce", ['error' => $e]);
            $nomeDocente = DB::table('docentes')
            ->where('id_docente', $request->input('id_docente'))
            ->value('nome_docente');
            return response()->json(['response' => $e->getMessage(), "erro_message"=>"Area já alocada para este docente {$nomeDocente}"], 500);
        }    
       
    }
    
}
