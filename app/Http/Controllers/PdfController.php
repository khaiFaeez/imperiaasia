<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Invoice;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class PdfController extends Controller
{
    protected $fpdf;
    protected $portfolio;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
        $this->portfolio = Route::current() ? Route::current()->parameter("portfolio") : "";
    }


    public function index($portfolio, $id)
    {
        Config::set('database.default', $this->portfolio);
        $invoice  = Invoice::find($id);
        $this->fpdf->SetFont('Arial', 'B', 15);
        $this->fpdf->AddPage("L", ['100', '100']);
        $this->fpdf->Text(10, 10, $invoice->Inv_No);

        $this->fpdf->Output();

        exit;
    }
}
