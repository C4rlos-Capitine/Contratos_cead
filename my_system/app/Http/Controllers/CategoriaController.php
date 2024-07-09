<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function register_form()
    {
        return view('categoria.reg_form');
    }

    public function save(Request $data)
    {
        $data->validate([
            'designacao_categoria' => 'required',
        ]);

        $categoria = new Categoria;
        $categoria->designacao_categoria = $data->input('designacao_categoria');
        $categoria->save();

        return response()->json(['response' => 'Categoria Registado com sucesso']);
    }
    public function get_all() {
        $categoria = Categoria::all();
       // $htmlSnippet = view('curso.vizualisar', ['cursos' => $cursos])->render();
        return response()->json($categoria);
    }
}
