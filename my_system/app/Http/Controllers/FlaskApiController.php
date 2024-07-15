<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Disciplina;
use App\Models\Docente;
use App\Models\Leciona;
use Illuminate\Support\Facades\Log;

class FlaskApiController extends Controller
{
    public function get_prediction_by_teacher(Request $request)
    {
        
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:5000']);

        $codAreas = Leciona::select('cod_area_in_leciona')
            ->distinct()
            ->where('id_docente_in_leciona', $request->id_docente)
            ->get();

        $n_areas =  $codAreas->count();
        
        $areas = [];
        foreach ($codAreas as $area) {
            $areas[] = ['cod_area_in_leciona' => $area->cod_area_in_leciona];
        }
        
        try {
            // Passando parâmetros na requisição POST
            $response = $client->request('GET', '/prever_disciplinas', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'id_docente' => $request->id_docente,
                    'areas' => $areas,
                    'n_areas' =>  $n_areas
                ],
            ]);
        
            // Obtendo o corpo da resposta
            $responseBody = json_decode($response->getBody(), true);
        
            $disciplinas = [];
        
            // Processando a resposta para buscar informações adicionais sobre as disciplinas
            foreach ($responseBody['previsoes'] as $previsao) {
                foreach ($previsao['disciplinas_previstas'] as $disciplinaPrevista) {
                    $disciplina = Disciplina::select('nome_disciplina', 'id_curso_in_disciplina', 'designacao_curso', 'codigo_disciplina')
                        ->join('cursos', 'id_curso', '=', 'id_curso_in_disciplina')
                        ->where('codigo_disciplina', $disciplinaPrevista['codigo_disciplina'])
                        ->first();
        
                    if ($disciplina) {
                        $disciplinas[] = [
                            'id_curso' => $disciplina->id_curso_in_disciplina,
                            'curso' => $disciplina->nome_disciplina,
                            'disciplina' => $disciplina->designacao_curso,
                            'codigo' => $disciplina->codigo_disciplina,
                            'probabilidade' => $disciplinaPrevista['probabilidade'] // Inclui a probabilidade no resultado
                        ];
                    }
                }
            }

            // Ordenar o array $docentes em função das probabilidades (decrescente)
            usort($disciplinas, function($a, $b) {
                return $b['probabilidade'] <=> $a['probabilidade'];
            });
        
            // Retornar a resposta como JSON
            return response()->json(['response'=>$disciplinas]);
        
        } catch (\Exception $e) {
            // Trate erros de solicitação aqui
            return response()->json(['error' => 'Erro ao acessar a API Flask: '.$e->getMessage() ], 500);
        }
    }

    public function get_prediction_by_subject(Request $request)
    {
        $client = new Client(['base_uri' => 'http://127.0.0.1:5000']);

        $cod_area = Disciplina::select("cod_area_in_disciplina")->where('codigo_disciplina', $request->codigo_disciplina)->get()->first();
        //return $cod_area;
        try{
            // Passando parâmetros na requisição GET
            $response = $client->request('GET', '/prever_docentes', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'codigo_disciplina' => $request->codigo_disciplina,
                    'cod_area' => $cod_area->cod_area_in_disciplina
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $docentes_previstos = $data['docentes_previstos'];
            $docentes = [];
            $logs = [];

            Log::info('IDs de top_professores_ids:', $docentes_previstos);

            foreach ($docentes_previstos as $docente_previsto) {
                $id = $docente_previsto['docente'];
                $probabilidade = $docente_previsto['probabilidade'];

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
                        'id' => $docente['id_docente'],
                        'probabilidade' => $probabilidade
                    ];
                    $logs[] = "Docente encontrado: " . $docente->nome_docente;
                } else {
                    Log::warning("Docente não encontrado para ID: $id"); // Log de erro quando docente não encontrado
                    $logs[] = "Docente não encontrado para ID: $id";
                }
            }

            Log::info('Docentes array final:', $docentes); // Log do array final de docentes
            // Ordenar o array $docentes em função das probabilidades (decrescente)
            usort($docentes, function($a, $b) {
                return $b['probabilidade'] <=> $a['probabilidade'];
            });
            // Inclua os logs na resposta
            return response()->json([
                'docentes' => $docentes,
                'logs' => $logs,
            ]);

        } catch (\Exception $e) {
            // Trate erros de solicitação aqui
            return response()->json(['error' => 'Erro ao acessar o modelo de ML: ' . $e->getMessage()], 500);
        }
    }

}
