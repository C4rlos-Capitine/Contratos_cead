<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contrato_laboratorio;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Support\Facades\DB;
class ContratoLaboratorioController extends Controller
{

    public function ver()
    {
        $cursos = Curso::select('*')
            ->join('faculdades', 'faculdades.id_faculdade', '=', 'cursos.id_faculdade_in_curso')
            ->join('centro_recursos', 'centro_recursos.id_centro', '=', 'cursos.id_centro_in_curso')
            ->get();
            //UNFINISHED
        $contratos = contrato_laboratorio::select("*")
            ->join("cursos", "cursos.id_curso", "=", "contrato_laboratorios.id_curso")
            ->join("disciplinas", "disciplinas.codigo_disciplina", "=", "contrato_laboratorios.codigo_disciplina")
            ->join("docentes", "docentes.id_docente", "=", "contrato_laboratorios.id_tecnico")
            ->get();
        return view('contrato.lab_ver', ['cursos'=>$cursos, 'contratos'=>$contratos, 'docentes'=>Docente::all()]);
    }

    public function save(Request $request)
    {
        try{
            //return response()->json(['response'=>$request->all()]);
            $contrato = new contrato_laboratorio;
            $contrato->id_tecnico = $request->id_docente;
            $contrato->ano_contrato = $request->ano; 
            $contrato->codigo_disciplina = $request->disciplina;
            $contrato->id_curso = $request->curso;
            $contrato->remuneracao_hora = 400;
            $contrato->save();
            return response()->json(['response' => 'contrato registado registado com sucesso', 'status'=>1], 201);
        } catch (\Exception $e) {
            return response()->json(['response' => $e->getMessage(), 'status'=>0]);
        }
        
    }
}
