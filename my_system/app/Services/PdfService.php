<?php

namespace App\Services;

use Illuminate\Support\Facades\View; //import View so you can return a view
use Mpdf\Mpdf;

class PdfService
{
    protected $mpdf;

    public function __construct()
    {
        $this->mpdf = new Mpdf();
    }

    public function renderBladeToHtml($bladeView, $data = [])
    {
        return View::make($bladeView, $data)->render();
    }

    public function generatePdf($html, $filename)
    {
        //$this->mpdf->SetFooter('{PAGENO}');
        $this->mpdf->SetHTMLFooter('<div style="text-align: right;">{PAGENO}</div>');
        //$this->mpdf->showFooter = false; //to hide the line of the Header
        $this->mpdf->WriteHTML($html);
        //$this->mpdf->Output($filename, 'D'); // 'D' sends the file inline to the browser
        $this->mpdf->Output($filename, 'I'); // 'I' opens the file inline in the browser
    }
}
