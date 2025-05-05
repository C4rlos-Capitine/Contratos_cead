<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clausula_contrato;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClausulaController extends Controller
{
    /**
     * Exibe uma lista de cláusulas.
     */
    public function ver()
    {
        $clausulas = clausula_contrato::all();
        //return response()->json($clausulas);
        return view('clausula.ver', ['clausulas' => $clausulas]);
    }

    public function create()
    {
        // Retorna uma view para criar uma nova cláusula
        return view('clausula.create');
    }

    /**
     * Armazena uma nova cláusula.
     */
    public function store(Request $request)
    {
       // Log::info("request data", ['response' => $request->all()]);
        try{
            $request->validate([
                'ordem_clausula' => 'nullable|integer',
                'titulo_clausula' => 'nullable|string|max:255',
                'subtitulo_clausula' => 'nullable|string|max:255',
                'descricao_clausula' => 'nullable|string',
            ]);
    
            $clausula = clausula_contrato::create($request->all());
    
            return response()->json(['success' => 'Cláusula criada com sucesso!', 'clausula' => $clausula]);
        
            }catch(\Exception $e){
                return response()->json(['error' => 'Erro ao cadastrar a cláusula: ' . $e->getMessage()]);
                Log::info("request data", ['response' => $user->$e->getMessage()]);
            }
           }

    /**
     * Exibe uma cláusula específica.
     */
    public function show($id)
    {
        try{
            $clausula = clausula_contrato::find($id);
            Log::info("request data", ['response' => $id]);
            if (!$clausula) {
                return response()->json(['error' => 'Cláusula não encontrada.'], 404);
            }
    
            return response()->json($clausula);
        }catch(\Exception $e){
            return response()->json(['error' => 'Erro ao buscar a cláusula: ' . $e->getMessage()]);
            Log::info("request data", ['error' => $user->$e->getMessage()]);
        }

    }

    /**
     * Exibe os detalhes de uma cláusula.
     */
    public function detalhes($id)
    {
        $clausula = clausula_contrato::find($id);

        if (!$clausula) {
            return redirect()->back()->with('error', 'Cláusula não encontrada.');
        }

        return view('clausula.detalhes', compact('clausula'));
    }

    /**
     * Atualiza uma cláusula existente.
     */
    public function update(Request $request, $id)
    {
        $clausula = clausula_contrato::find($id);

        if (!$clausula) {
            return response()->json(['error' => 'Cláusula não encontrada.'], 404);
        }

        $request->validate([
            'ordem_clausula' => 'nullable|integer',
            'titulo_clausula' => 'nullable|string|max:255',
            'subtitulo_clausula' => 'nullable|string|max:255',
            'descricao_clausula' => 'nullable|string',
        ]);

        $clausula->update($request->all());

        return response()->json(['success' => 'Cláusula atualizada com sucesso!', 'clausula' => $clausula]);
    }

    /**
     * Remove uma cláusula.
     */
    public function destroy($id)
    {
        $clausula = clausula_contrato::find($id);

        if (!$clausula) {
            return response()->json(['error' => 'Cláusula não encontrada.'], 404);
        }

        $clausula->delete();

        return response()->json(['success' => 'Cláusula removida com sucesso!']);
    }
}