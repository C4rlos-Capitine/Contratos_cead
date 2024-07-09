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

    public static function getDisciplinasLecionadas($id_docente, $tipo_contrato)
    {
  
        //return response()->json($request->all());
        if(isset($request->tipo_contrato)){
            $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->where('lecionas.id_docente_in_leciona', $id_docente)
                ->where('docentes.id_docente', $id_docente)
                ->where('lecionas.id_tipo_contrato_in_leciona', $tipo_contrato)
                ->where('lecionas.ano_contrato', date("Y"))
                ->get();

            }else{
                $disciplinas = Leciona::select("*")
                ->join('docentes', 'lecionas.id_docente_in_leciona', '=', 'docentes.id_docente')
                ->join('cursos', 'lecionas.id_curso_in_leciona', '=', 'cursos.id_curso')
                ->join('disciplinas', 'lecionas.codigo_disciplina_in_leciona', '=', 'disciplinas.codigo_disciplina')
                ->join('categorias', 'disciplinas.id_cat_disciplina', '=', 'categorias.id_cat_disciplina') // Add this join
                ->where('lecionas.id_docente_in_leciona', $id_docente)
                ->where('docentes.id_docente', $id_docente) 
                ->where('lecionas.ano_contrato', date("Y"))
                ->get();
            }
            return $disciplinas;
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

    public function generatePdf(Request $request){
        $docente = PDFController::getDocente($request->id_docente);
        $disciplinas = PDFController::getDisciplinasLecionadas($request->id_docente, $request->tipo_contrato);

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


}
