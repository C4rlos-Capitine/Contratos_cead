<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\area_cientifica;
use App\Models\Table_fonte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class FonteController extends Controller
{
    public function save(Request $request){
        try{
            $fonte = new Table_fonte;
            $fonte->nome_fonte = $request->nome_fonte;
       
            $fonte->save();
            return response()->json(['response' => 'Fonte Registada com sucesso', 'status'=>"success"]);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage()]);
            //\Log::error($e->getMessage());
            //return response()->json(['response' => "O contrato já existe", 'status'=>"error"]);
        }
    }

    public function get(){
        try{
            $fontes = Table_fonte::all();
            return response()->json(['response'=>$fontes]);
        }catch(\Exception $e){
            return response()->json(['response' => $e->getMessage()]);
        }
    }

    /*
    $disciplina = Disciplina::where('codigo_disciplina', $codigo_disciplina)->first();
        if (!$disciplina) {
            return redirect()->back()->with('error', 'Disciplina não encontrada');
        }

        $disciplina->nome_disciplina = $request->input('nome_disciplina');
        $disciplina->sigla_disciplina = $request->input('sigla');
        $disciplina->id_cat_disciplina = $request->input('id_categoria');
        $disciplina->id_curso_in_disciplina = $request->input('id_curso');
        $disciplina->ano = $request->input('ano_curso');
        $disciplina->semestre = $request->input('semestre_curso');
        $disciplina->horas_contacto = $request->input('horas_c');
        $disciplina->cod_area_in_disciplina = $request->input('cod_area');
        $disciplina->save();

        return redirect()->route('disciplina.edit', $codigo_disciplina)->with('success', 'Disciplina atualizada com sucesso!');
    */

    public function update(Request $request){
        try{
            $fonte = Table_fonte::where('id_fonte', 1)->first();
            if (!$fonte) {
                return response()->json(['response'=>'Erro a alterar a fonte']);
            }
    
            $fonte->nome_fonte = $request->new_font;
            $fonte->update(['nome_fonte' => $request->new_font]);
            return response()->json(['response'=>'Alterada']);
        }catch(\Exception $ex){
              Log::info("request data", ['error' => $ex->getMessage()]);
            return response()->json(['response'=>'Erro']);
        }

    }
}
