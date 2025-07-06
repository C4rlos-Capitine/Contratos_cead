<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use App;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Services\PdfService;

use App\Models\Nivel;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Leciona;
use App\Models\Tipo_contrato;
use App\Models\Contrato_laboratorio;
use App\Models\clausula_contrato;
use App\Models\Table_fonte;
use App\Models\tamanho_fonte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class PDFController extends Controller
{


    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public static function getDocente($id_docente)
    {
        $docente = Docente::select('*')
            ->join('nivels', 'nivels.id_nivel', '=', 'docentes.id_nivel')
            ->where('id_docente', $id_docente)
            ->first();
        return $docente;
    }

    public static function getDisciplinasLecionadas($id_docente, $tipo_contrato, $ano)
    {
  
        //return response()->json($request->all());
        if(isset($request->tipo_contrato)){
            $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->join('centro_recursos', 'cursos.id_centro_in_curso', '=', 'centro_recursos.id_centro')
                ->where('lecionas.id_docente_in_leciona', $id_docente)
                ->where('docentes.id_docente', $id_docente)
                ->where('lecionas.id_tipo_contrato_in_leciona', $tipo_contrato)
                ->where('lecionas.ano_contrato', ano)
                ->get();

            }else{
                $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->join('centro_recursos', 'cursos.id_centro_in_curso', '=', 'centro_recursos.id_centro')//id_centro_in_curso
                ->where('lecionas.id_docente_in_leciona', $id_docente)
                ->where('docentes.id_docente', $id_docente) 
                ->where('lecionas.ano_contrato', $ano)
                ->get();
            }
            return $disciplinas;
    }

    private static function get_representanteAtivo()
    {
        try {
            $representantes = DB::table('table_representante_ativo')
                ->join('representantes', 'table_representante_ativo.id_representante', '=', 'representantes.id_representante')
                ->select('*')
                ->get()->first();

            return $representantes;
        } catch (\Exception $e) {
            Log::info("request data", ['response' => $e->getMessage()]);
            return response()->json(['error' => 'Erro ao obter os representantes ativos: ' . $e->getMessage()]);
        }
    }

    public function generate(Request $request){
        
        //$pdf = App::make('dompdf.wrapper');
        $docente = PDFController::getDocente($request->id_docente);
        $disciplinas = PDFController::getDisciplinasLecionadas($request->id_docente, $request->tipo_contrato);

        if (empty($docente)){
           return response()->json(['response'=>'docente inexistente']);
        }

        if (empty($disciplinas)) {
            return response()->json(['response'=>'docente sem disciplinas']);
        }

        //$pdf = Pdf::loadView('contrato', ['docente'=> $docente, 'disciplinas'=>$disciplinas]);
        //$pdf->loadHTML('<h1>Test</h1>');
        //return $pdf->stream();
        $html = view('contrato', ['docente' => $docente, 'disciplinas' => $disciplinas])->render();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        // Load page number HTML content
        $page_number_html = view('page_number')->render(); // Load your page number HTML content from a Laravel view

        // Add the page number to each page
        $dompdf->getOptions()->setIsPhpEnabled(true);
        $dompdf->loadHtml($html);

        // Render the HTML as PDF
        $dompdf->render();

        // Add page numbers using CSS
        $canvas = $dompdf->getCanvas();
        $font = $dompdf->getFontMetrics()->getFont('Arial', 'normal');
        $size = 12;
        $canvas->page_text(36, 780, $page_number_html, $font, $size, array(0,0,0));

        // Output the generated PDF to Browser
        $pdf_content = $dompdf->output();
        return response($pdf_content, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="your_file_name.pdf"');

    }

    public function generatePdf($id_docente=null,$ano=null){
        $docente = PDFController::getDocente($id_docente);
        $disciplinas = PDFController::getDisciplinasLecionadas($id_docente, 1, $ano);

        if (empty($docente)){
            return response()->json(['response'=>'docente inexistente']);
        }

        if (empty($disciplinas)) {
            return response()->json(['response'=>'docente sem disciplinas']);
        }

        // Pass data to the Blade view
        $bladeView = 'contrato'; // Blade file name without '.blade.php' extension
        $html = view($bladeView, compact('docente', 'disciplinas'))->render();
        $filename = 'example.pdf';

        // Generate PDF from HTML
        $this->pdfService->generatePdf($html, $filename);

    }

    private static function get_clausulas(){
        $clausulas = DB::table('clausula_contrato')
            ->select('clausula_contrato.*')
            ->orderBy('ordem_clausula', 'asc')
            ->get();
        return $clausulas;
    }

    
public function generatePdf_contrato($id_docente = null, $ano = null)
{
    $docente = PDFController::getDocente($id_docente);
    
    $disciplinas = PDFController::getDisciplinasLecionadas($id_docente, 1, $ano);
    $clausulas = PDFController::get_clausulas();
    $contrato = DB::table('contratos')->where('id_docente_in_contrato', $id_docente)
        ->where('ano_contrato', $ano)
        ->first();
    if (empty($docente)) {
        return response()->json(['response' => 'docente inexistente']);
    }

    if (empty($disciplinas)) {
        return response()->json(['response' => 'docente sem disciplinas']);
    }

    // Substituir placeholders no texto da cláusula inicial

        foreach ($clausulas as $clausula) {
            $clausula->descricao_clausula = str_replace(
                ['{{nivel}}', '{{nome_docente}}', '{{bi}}', '{{nuit}}', '{{nacionalidade}}', '{{ano}}', '{{remuneracao_hora}}', '{{carga_horaria}}' ],
                [
                    '<b>' . $docente->nivel . '</b>',
                    '<b>' . $docente->nome_docente . '</b>',
                    '<b>' . $docente->bi . '</b>',
                    '<b>' . $docente->nuit . '</b>',
                    '<b>' . $docente->nacionalidade . '</b>',
                    '<b>' . $ano . '</b>',
                    '<b>' . $docente->remuneracao_hora . '</b>',
                    '<b>' . $contrato->carga_horaria . '</b>'
                ],
                $clausula->descricao_clausula
            );
        }
        $representante = PDFController::get_representanteAtivo();
   $fonte = Table_fonte::where('id_fonte', 1)->first();
     $tamanhoFonte = tamanho_fonte::where('id_tamanho_fonte', 1)->first();
    // Passar os dados para a view
    $bladeView = 'contrato_tutoria'; // Nome do arquivo Blade
    $html = view($bladeView, compact('docente', 'disciplinas', 'clausulas', 'representante', 'fonte', 'tamanhoFonte'))->render();
    $filename = 'contrato.pdf';

    // Gerar o PDF
    $this->pdfService->generatePdf($html, $filename);
}

public function previewContrato()
{
    $clausulas = PDFController::get_clausulas();
    // Mock docente
    $docente = (object)[
        'id_nivel' => 2,
        'nivel' => 'Mestre',
        'nome_docente' => 'João Exemplo',
        'bi' => '123456789',
        'nuit' => '987654321',
        'nacionalidade' => 'Moçambicana',
        'remuneracao_hora' => '1000',
    ];

    // Mock disciplinas
    $disciplinas = collect([
        (object)[
            'nome_disciplina' => 'Matemática',
            'horas_contacto' => 20,
            'designacao_curso' => 'Engenharia',
            'ano' => 1,
            'semestre' => 1,
            'nome_centro' => 'Centro A'
        ],
        (object)[
            'nome_disciplina' => 'Física',
            'horas_contacto' => 15,
            'designacao_curso' => 'Engenharia',
            'ano' => 1,
            'semestre' => 2,
            'nome_centro' => 'Centro B'
        ]
    ]);

    // Mock cláusulas com campos necessários
   
    $contrato = (object)[
        'carga_horaria' => '40'
    ];


    $ano = date('Y');

    // Substituir placeholders nas cláusulas
    foreach ($clausulas as $clausula) {
        $clausula->descricao_clausula = str_replace(
            ['{{nivel}}', '{{nome_docente}}', '{{bi}}', '{{nuit}}', '{{nacionalidade}}', '{{ano}}', '{{remuneracao_hora}}', '{{carga_horaria}}'],
            [
                '<b>' . $docente->nivel . '</b>',
                '<b>' . $docente->nome_docente . '</b>',
                '<b>' . $docente->bi . '</b>',
                '<b>' . $docente->nuit . '</b>',
                '<b>' . $docente->nacionalidade . '</b>',
                '<b>' . $ano . '</b>',
                '<b>' . $docente->remuneracao_hora . '</b>',
                '<b>' . $contrato->carga_horaria . '</b>'
            ],
            $clausula->descricao_clausula
        );
    }
        $representante = PDFController::get_representanteAtivo();
        $fonte = Table_fonte::where('id_fonte', 1)->first();
        $tamanhoFonte = tamanho_fonte::where('id_tamanho_fonte', 1)->first();

    // Renderizar a view normalmente (sem gerar PDF)
     $bladeView = 'contrato_tutoria_preview'; // Nome do arquivo Blade
    $html = view($bladeView, compact('docente', 'disciplinas', 'clausulas', 'representante', 'fonte', 'tamanhoFonte'))->render();
    $filename = 'contrato.pdf';

    // Gerar o PDF
    $this->pdfService->generatePdf($html, $filename);
    //return view('contrato_tutoria', compact('docente', 'disciplinas', 'clausulas'));
}
    public function generatePdf_lab($ano = null, $id_tecnico=null)
    {
            $contrato = DB::table('contrato_labs')
        ->join('tecnicos', 'tecnicos.id_tecnico', '=', 'contrato_labs.id_tecnico')
        ->join('cursos', 'cursos.id_curso', '=', 'contrato_labs.id_curso')
        ->join('disciplinas', 'disciplinas.codigo_disciplina', '=', 'contrato_labs.codigo_disciplina')
        ->where('ano_contrato', $ano)
        ->where('tecnicos.id_tecnico', $id_tecnico)
        ->select('contrato_labs.*', 'tecnicos.nome_tecnico', 'tecnicos.apelido_tecnico', 'tecnicos.bi', 'tecnicos.nuit', 'tecnicos.nacionalidade', 'cursos.designacao_curso') // Specify the columns you need
        ->first(); // Fetch only one record

        

        // Pass data to the Blade view
        $bladeView = 'contrato_lab'; // Blade file name without '.blade.php' extension
        $html = view($bladeView, compact('contrato'))->render();
        $filename = 'contrato_lab.pdf';

        // Generate PDF from HTML
        $this->pdfService->generatePdf($html, $filename);
    }


}
