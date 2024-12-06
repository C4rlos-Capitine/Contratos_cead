<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CentroRecursoController extends Controller
{
    public function teste()
    {
        $cursos = DB::table('cursos')
            ->join('centro_recursos', 'cursos.id_centro_in_curso', '=', 'centro_recursos.id_centro')
            ->select('cursos.*', 'centro_recursos.*')
            ->get();
            return response()->json($cursos);
    }
}
