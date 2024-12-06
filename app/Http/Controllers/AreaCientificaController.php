<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\area_cientifica;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AreaCientificaController extends Controller
{
    public function get_areas(){
        return response()->json( ['areas'=>$areas = area_cientifica::all()]);
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
            $nomeDocente = DB::table('docentes')
            ->where('id_docente', $request->input('id_docente'))
            ->value('nome_docente');
            return response()->json(['response' => $e->getMessage(), "erro_message"=>"Area já alocada para este docente {$nomeDocente}"], 500);
        }    
       
    }
    
}
