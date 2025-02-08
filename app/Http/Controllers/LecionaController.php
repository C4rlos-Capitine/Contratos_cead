<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leciona;
use Illuminate\Support\Facades\DB;

class LecionaController extends Controller
{
    

    public function check_disciplinas_in_contrato(Request $request)
    {
        $registos = Leciona::select('*')
            //->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
            ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
            ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
            ->where('lecionas.ano_contrato', '=', date('Y')) // Changed "ano" to "ano_contrato"
            //->where('lecionas.id_docente_in_leciona', '=', $request->id_docente)
            ->where('lecionas.id_curso_in_leciona', '=', $request->id_curso)
            ->where('lecionas.codigo_disciplina_in_leciona', '=', $request->codigo_disciplina)
            //->where('lecionas.id_tipo_contrato_in_leciona', $request->tipo_contrato)
            ->get();

        // Count the number of records
        return $registos->count();
        //echo "Number of records: " . $numberOfRecords;

    }

    public function test(Request $request)
    {
        $codAreas = Leciona::select('cod_area_in_leciona')
        ->distinct()
        ->where('id_docente_in_leciona', $request->id_docente)
        ->get();
        return response(["areas"=>$codAreas]);
    }

    public function delete(Request $request){
        try{
            
            /*\Log::info('Valores recebidos para exclusão:', [
                'id_docente' => $request->id_docente,
                'cod_disciplina' => $request->cod_disciplina,
                'ano' => intval($request->ano),
            ]);
*/
            $exists = DB::table('contratos')->where('id_docente_in_contrato', $request->id_docente)->where('ano_contrato', intval($request->ano))->count();
           // \Log::info('query', ['exists'=>$exists]);
            if($exists>=1){
                return response()->json(['response'=>'Não pode excluir este registo, pois o contrato já foi gerado', 'success'=>0]);
            }


            DB::table('lecionas')
            ->where('id_docente_in_leciona', $request->id_docente)
            ->where('codigo_disciplina_in_leciona', $request->cod_disciplina)
            ->where('ano_contrato', $request->ano)
            ->delete();
            return response()->json(['response'=>'Disciplina removida com sucesso', 'success'=>1], 200);
        }catch(\Exception $e){
            return response()->json(['response'=>$e->getMessage()], 500);
        }

    }
    
}
