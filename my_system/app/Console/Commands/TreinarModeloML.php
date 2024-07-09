<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Leciona;

class TreinarModeloML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modelo:treinar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // Obter os dados da base de dados como array associativo
            $dados = Leciona::select("id_docente_in_leciona", "codigo_disciplina_in_leciona")
                            //->where("ano_contrato", 2024)
                            ->get()
                            ->toArray();

            // Converter os dados para JSON
            $dadosJson = json_encode($dados);

            // Definir o caminho absoluto para o arquivo existente
            $caminhoArquivo = base_path('python/dados.json');

            // Escrever os dados no arquivo existente
            file_put_contents($caminhoArquivo, $dadosJson);
            $Arquivo = base_path('python\dados.json');
            // Definir o caminho absoluto para o script Python de treinamento do modelo
            $caminhoScriptPython = base_path('python/ml_treino2.py');

            // Executar o comando Python utilizando exec() do PHP com o caminho do arquivo existente
            exec("python {$caminhoScriptPython} {$Arquivo} 2>&1", $output, $return_var);

            // Verificar se a execução do script foi bem-sucedida
            if ($return_var !== 0) {
                $this->info('Modelo de machine learning treinado com sucesso utilizando o script Python.');
            } else {
                $this->error('Erro ao treinar o modelo utilizando o script Python.');
                foreach ($output as $line) {
                    $this->error($line); // Exibir cada linha de saída como erro
                }
            }

            return 0; // Retornar código de sucesso
        } catch (\Exception $e) {
            // Capturar e registrar exceções
            $this->error('Erro inesperado: ' . $e->getMessage());
            return 1; // Retornar código de erro
        }
    }

}
