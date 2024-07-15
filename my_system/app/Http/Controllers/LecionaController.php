<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leciona;
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
    
}
