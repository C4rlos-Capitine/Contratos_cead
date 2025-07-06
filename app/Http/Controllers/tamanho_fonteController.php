<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tamanho_fonte;
class tamanho_fonteController extends Controller
{

    public function update(Request $request)
    {
        try {
            $tamanho = tamanho_fonte::where('id_tamanho_fonte', 1)->first();
            if (!$tamanho) {
                return response()->json(['response' => 'Erro ao alterar o tamanho da fonte']);
            }

            $tamanho->tamanho_fonte = $request->new_size;
            $tamanho->update(['tamanho_fonte' => $request->new_size]);
            return response()->json(['response' => 'Tamanho alterado com sucesso']);
        } catch (\Exception $ex) {
            \Log::info("request data", ['error' => $ex->getMessage()]);
            return response()->json(['response' => 'Erro']);
        }
    }
}
