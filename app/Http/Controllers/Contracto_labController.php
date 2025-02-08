<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\contrato_lab;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class Contracto_labController extends Controller
{
    public function save(Request $request){
        try{
            
           // return response()->json(['response'=>$request->all()]);
            $contrato = new contrato_lab;   
            $contrato->id_tecnico = $request->id_tecnico;
            $contrato->codigo_disciplina = $request->codigo_disciplina;
            $contrato->id_curso = $request->id_curso;
            $contrato->ano_contrato = $request->ano_contrato;
            $contrato->remuneracao_hora = 400;
            $contrato->save();
            return response()->json(['response'=>'Contrato registado com sucesso']);
        }catch(\Exception $e){
            return response()->json(['response'=>$e->getMessage()]);
        }

    }

    public function all($ano = null){
        $contratos = DB::table('contrato_labs')
        ->join('tecnicos', 'tecnicos.id_tecnico', '=', 'contrato_labs.id_tecnico')
        ->join('cursos', 'cursos.id_curso', '=', 'contrato_labs.id_curso')
        ->join('disciplinas', 'disciplinas.codigo_disciplina', '=', 'contrato_labs.codigo_disciplina')
        ->where('ano_contrato', $ano)
       // ->select('contrato_labs.*', 'tecnicos.*')
        ->get();
        return response()->json(['tecnicos'=>$contratos]);
    }
}
