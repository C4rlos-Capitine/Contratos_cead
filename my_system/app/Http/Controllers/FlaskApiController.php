<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Disciplina;
use App\Models\Docente;
use Illuminate\Support\Facades\Log;

class FlaskApiController extends Controller
{
    public function get_prediction_by_teacher(Request $request)
    {
        
        $client = new Client(['base_uri' => 'http://127.0.0.1:5000']);
        
        try {
            // Passando parâmetros na requisição GET
            $response = $client->request('GET', '/prever_disciplinas', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'id_docente' => $request->id_docente, // Parâmetro que você deseja passar
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
           
            $disciplinas = [];
            for ($i=0; $i < sizeof($data["disciplinas_previstas"]); $i++) { 
               $disciplina = Disciplina::select('nome_disciplina','id_curso_in_disciplina', 'designacao_curso', 'codigo_disciplina')
               ->join('cursos', 'id_curso', '=', 'id_curso_in_disciplina')
               ->where('codigo_disciplina', $data["disciplinas_previstas"][$i])
               ->get()->first();
               $disciplinas[$i]['id_curso'] = $disciplina["id_curso_in_disciplina"];
               $disciplinas[$i]['curso'] = $disciplina["nome_disciplina"];
               $disciplinas[$i]['disciplina'] = $disciplina["designacao_curso"];
               //$disciplinas[$i]['id_cat'] = $disciplina["id_cat_disciplina"];
               $disciplinas[$i]['codigo'] = $disciplina["codigo_disciplina"];
            }
            // Manipule os dados conforme necessário
            return response()->json($disciplinas);
        } catch (\Exception $e) {
            // Trate erros de solicitação aqui
            return response()->json(['error' => 'Erro ao acessar a API Flask: '.$e->getMessage() ], 500);
        }
    }

    public function get_prediction_by_subject(Request $request)
    {
        $client = new Client(['base_uri' => 'http://127.0.0.1:5000']);
        
        try{
            $response = $client->request('GET', '/prever_professores', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'codigo_disciplina' => $request->codigo_disciplina, // Parâmetro que você deseja passar
                ],
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            $docentes = [];
            $logs = [];
            //return response()->json($data);
            $professores_ids = $data['top_professores_ids'][0];

    Log::info('IDs de top_professores_ids:', $professores_ids);

    foreach ($professores_ids as $id) {
        Log::info("Processando ID: $id"); // Log do ID sendo processado

        // Consultar o docente pelo ID
        $docente = Docente::select('id_docente', 'nome_docente', 'apelido_docente')
                          ->where('id_docente', $id)
                          ->first();

        if ($docente) {
            Log::info("Docente encontrado: " . $docente->nome_docente); // Log do docente encontrado

            $docentes[] = [
                'nome' => $docente['nome_docente'],
                'apelido' => $docente['apelido_docente'],
                'id' => $docente['id_docente']
            ];
            $logs[] = "Docente encontrado: " . $docente->nome_docente;
        } else {
            Log::warning("Docente não encontrado para ID: $id"); // Log de erro quando docente não encontrado
            $logs[] = "Docente não encontrado para ID: $id";
        }
    }

    Log::info('Docentes array final:', $docentes); // Log do array final de docentes

    // Inclua os logs na resposta
    return response()->json([
        'docentes' => $docentes,
        'logs' => $logs,
    ]);            
        } catch (\Exception $e) {
            // Trate erros de solicitação aqui
            return response()->json(['error' => 'Erro ao acessar o modelo de ML: '.$e->getMessage() ], 500);
        }
    }

}
