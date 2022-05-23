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
    protected $company_name;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
        $this->portfolio = Route::current() ? Route::current()->parameter("portfolio") : "";
    }


    public function printInvoices($invoices)
    {
        foreach ($invoices as $invoice) {
            $this->generatePage($invoice);
        }

        $this->fpdf->Output();

        exit;
    }

    public function printInvoice($portfolio, $id)
    {
        $invoice  = Invoice::find($id);
        $this->generatePage($invoice);
        $this->fpdf->Output();

        exit;
    }

    public function generatePage($invoice)
    {
        $gst = $invoice->Grand_Total / 106 * 0;
        $header = array('Bill To: ', 'Deliver To', 'INVOICE/DELIVERY ORDER');
        $data = array('Invoice No. :INV-100000', 'Date', 'Reference', 'Terms', 'Salesperson', 'Page', 'Promise to pay');
        $invoices = array();
        $currY = 0;

        // $this->fpdf->SetFont('Arial', 'B', 8);

        $this->fpdf->AliasNbPages();
        $this->fpdf->SetAutoPageBreak(false);
        $this->fpdf->AddPage();
        $this->header();
        $this->billDeliver($header, $invoice, $currY);
        $this->products($invoice, $currY);
        $this->fpdf->Ln();


        $this->fpdf->SetY(-125);
        $this->fpdf->Cell(180, 4, '', 'T', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->SetY(-120);
        $this->fpdf->Cell(60, 4, ' ', 0, 0);
        $this->fpdf->Cell(80, 4, '', 0, 0);
        $this->fpdf->Cell(20, 4, 'Total Amount : ', 0, 0, 'R');
        $this->fpdf->Cell(20, 4, $invoice->Grand_Total, 1, 0, 'L');
        $this->fpdf->Ln();
        $this->footer();
    }

    public function header()
    {

        // Arial bold 15
        $this->fpdf->SetFont('times', 'B', 20);
        // Move to the right
        $this->fpdf->Cell(80);
        // COMPANY NAME

        $this->fpdf->Cell(30, 10, config('portfolio.company.' . $this->portfolio . '.name'), 0, 1, 'C');
        $this->fpdf->SetFont('times', 'I', 10);
        $this->fpdf->SetY(14);
        $this->fpdf->SetX(128);
        $this->fpdf->Cell(0, 5, '(' . config('portfolio.company.' . $this->portfolio . '.ssm') . ')', 0, 1, 'C');



        $this->fpdf->SetFont('times', 'B', 10);
        $this->fpdf->Cell(0, 3, config('portfolio.company.' . $this->portfolio . '.address'), 0, 1, 'C');
        $this->fpdf->Cell(0, 5,  config('portfolio.company.' . $this->portfolio . '.contact'), 0, 1, 'C');

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('times', 'B', 15);
        $this->fpdf->Cell(0, 3, 'TAX INVOICE', 0, 1, 'C');
        $this->fpdf->Ln(11);
        $this->fpdf->SetFont('times', 'B', 10);
    }

    public function footer()
    {

        $this->fpdf->SetY(-105);
        $this->fpdf->Cell(75, 4, '1) Goods sold are non-returnable*', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(75, 4, '2) Full payment shall be made within 7 days from invoice date*', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(75, 4, '3) Legal action will be taken on overdue account & all charges will be borne by customer*', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(75, 4, '4) Interest at the rate 1.5% permonth will be charged on all overdue account*', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(75, 4, '5) Payment By Cheque must pay to : ' . config('portfolio.company.' . $this->portfolio . '.name') . '*', 0, 0);
        $this->fpdf->Ln();
        /* $this->fpdf->Cell(75,4,'6) Year End Sale Voucher RM20 valid until 30 April 2022*',0,0);$this->fpdf->Ln();*/
        /*$this->fpdf->Cell(75,5,'6) Payment to be bank-in to a/c :',0,0);$this->fpdf->Ln();

            $this->fpdf->Cell(75,5,'    CIMB Bank - 8600930280      RHB Bank - 26205400021794',0,0);$this->fpdf->Ln();
            $this->fpdf->Cell(75,4,'    Maybank - 512848510504  Public Bank - 3198118623  ',0,0);$this->fpdf->Ln();
            $this->fpdf->Cell(75,4,'    BSN - 1016341000058389 (MUHAMMAD TARMIZIE)',0,0);$this->fpdf->Ln();*/
        // $this->fpdf->Cell(75,4,'7) myimperiaasia.com - MOLPAY',0,0);$this->fpdf->Ln();


        $this->fpdf->SetXY(28, 217);
        $this->fpdf->Cell(84, 29, '', 1, 0, 'L');

        $this->fpdf->SetXY(50, 221);
        $this->fpdf->Cell(75, 4, 'Biller Code : 82214 ', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->SetXY(50, 225);
        $this->fpdf->Cell(75, 4, 'Ref-1 :  I/C No.', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->SetXY(50, 229);
        $this->fpdf->Cell(50, 4, 'Ref-2 : Phone No.', 0, 0);
        $this->fpdf->Ln();


        $this->fpdf->SetXY(48, 220);
        $this->fpdf->Cell(50, 14, '', 1, 0, 'L');


        $this->fpdf->Image(public_path() . '/JomPay_Blue_10mm-01.png', 30, 219, -700);

        $this->fpdf->SetXY(30, -61);
        $this->fpdf->MultiCell(80, 4, 'JomPAY online di Perbankan Internet dan Telefon Mudah Alih dengan akaun semasa atau simpanan', 0, 0);

        $this->fpdf->SetY(-50);
        $this->fpdf->Cell(75, 9, 'ISSUED BY', 0, 0, 'C');
        $this->fpdf->Cell(30, 9, ' ', 0, 0, 'C');
        $this->fpdf->Cell(75, 9, 'GOODS RECEIVED BY', 0, 0, 'C');
        //$this->fpdf->Ln(20);
        $this->fpdf->SetY(-30);
        $this->fpdf->Cell(75, 9, config('portfolio.company.' . $this->portfolio . '.name'), 'T', 0, 'C', 0);
        $this->fpdf->Cell(30, 9, ' ', 0, 0, 'C');
        $this->fpdf->Cell(75, 9, 'Company`s Stamp & Signature', 'T', 0, 'C', 0);
        // Position at 1.5 cm from bottom
        $this->fpdf->SetY(-20);
        // Arial italic 8
        $this->fpdf->SetFont('Arial', 'I', 8);
        // Page number
        $this->fpdf->Cell(180, 3, '"Jiwa Seorang Mukmin itu Tergantung Dengan Sebab Hutangnya Hinggalah Dijelaskan"', 0, 0, 'C');
        $this->fpdf->Ln();
        $this->fpdf->Cell(180, 3, '- Diriwayatkan Oleh Tarmizi, Ibn Majah, Ahmad Dan Hakim Dari Abu Hurairah -', 0, 0, 'C');
        $this->fpdf->Ln();
        $this->fpdf->Cell(180, 3, '"Roh Orang Mukmin Itu Akan Tersekat Di pintu Syurga Sehinggalah Dia Melunaskan Hutangnya"', 0, 0, 'C');
        $this->fpdf->Ln();
        $this->fpdf->Cell(180, 3, '- Riwayat Abu Daud -', 0, 0, 'C');
    }

    public function billDeliver($header, $invoice, &$currY)
    {
        // Header
        foreach ($header as $col)
            $this->fpdf->Cell(67, 4, $col, 0, 0);
        $this->fpdf->Ln();
        $sp = 4;

        /*$this->fpdf->Cell(67, $sp, $invoice->Name'], 0, 0);$this->fpdf->Cell(67, $sp, $invoice->Ship_Name'], 0, 0);             $this->fpdf->Cell(67, $sp, 'Invoice No.         : '.$invoice->Inv_No'], 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, $sp, $invoice->Address'], 0, 0);$this->fpdf->Cell(67, $sp, $invoice->Ship_Add1'], 0, 0);   $this->fpdf->Cell(67, $sp, 'Date                    : '.date("d/m/Y"), 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67,$sp, $invoice->Address_2'],0, 0);$this->fpdf->Cell(67, $sp, $invoice->Ship_Add2'], 0, 0);   $this->fpdf->Cell(67, $sp, 'Reference           : ', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67,$sp, $invoice->Poscode'].' '.$invoice->City'].' '.$invoice->State'], 0, 0);$this->fpdf->Cell(67, $sp, $invoice->Ship_poscode'].' '.$invoice->Ship_City'].' '.$invoice->Ship_State'], 0, 0);  $this->fpdf->Cell(67, $sp, 'Terms Payment : 7 DAYS', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, $sp,  $invoice->Country'], 0, 0);$this->fpdf->Cell(67, $sp, $invoice->Ship_Country'], 0, 0);                                  $this->fpdf->Cell(67, $sp, 'Salesperson        : '.$invoice->Consultant'], 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, $sp,  '', 0, 0);$this->fpdf->Cell(67, $sp, '', 0, 0);                                  $this->fpdf->Cell(67, $sp, 'CMD                   : '.$invoice->Cmd'], 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, $sp, 'TEL : '.$invoice->Mobile_No'], 0, 0);$this->fpdf->Cell(67, $sp, ' ', 0, 0);                               $this->fpdf->Cell(67, $sp, 'Page                    : 1 of 1', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, $sp, '', 0, 0);$this->fpdf->Cell(67, $sp, ' ', 0, 0);                                                  $this->fpdf->Cell(67, $sp, 'Promise to pay   : '.date("d/m/Y", time() + 604800), 0, 0);
        $this->fpdf->Ln();*/

        $w = 60; //$x = $this->fpdf->GetX();

        $this->fpdf->setXY(10, 55);
        $this->fpdf->MultiCell($w, $sp, $invoice->client->Name, 0, 'L', 0);
        $this->fpdf->setXY(75, 55);
        $this->fpdf->MultiCell(60, $sp, iconv('UTF-8', 'windows-1252', $invoice->Ship_Name), 0, 'L', 0);
        $this->fpdf->setXY(145, 55);
        $this->fpdf->MultiCell(50, $sp, 'Invoice No.       : ' . $invoice->Inv_No, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(145, $y);
        $this->fpdf->MultiCell(50, $sp, 'Date                  : ' . $invoice->Date, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(145, $y);
        $this->fpdf->MultiCell(60, $sp, 'Reference         : ' . $invoice->delivery?->Tracking_No, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(145, $y);
        $this->fpdf->MultiCell(50, $sp, 'Terms               : 7 DAYS', 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(145, $y);
        $this->fpdf->MultiCell(50, $sp, 'Salesperson      : ' . $invoice->consultant?->Name, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(145, $y);
        $this->fpdf->MultiCell(50, $sp, 'CMD                 : ' . $invoice->collector?->Name, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(145, $y);
        $this->fpdf->MultiCell(50, $sp, 'Page                   : 1 of 1', 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(145, $y);
        $this->fpdf->MultiCell(50, $sp, 'Promise to pay : ' . $invoice->Promise_pay, 0, 'L', 0);
        $y = $this->fpdf->GetY();


        $this->fpdf->SetY(59);
        // $y = $this->fpdf->GetY();

        $y = $this->fpdf->GetY();

        $this->fpdf->setXY(10, $y + $sp);
        $this->fpdf->MultiCell(60, $sp, $invoice->client->Address . ' ' . $invoice->client->Address_2, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(10, $y);
        $this->fpdf->MultiCell(60, $sp, $invoice->client->Poscode . ' ' . $invoice->client->City, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(10, $y);
        $this->fpdf->MultiCell(60, $sp, $invoice->client->state->Negeri ?? '', 0, 'L', 0);
        $this->fpdf->setXY(10, $y + $sp);
        $this->fpdf->MultiCell(60, $sp, $invoice->client->Country, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(10, $y);
        $this->fpdf->MultiCell(60, $sp, 'IC No.         : ' . $invoice->client->MyKad_SSM, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(10, $y);
        $this->fpdf->MultiCell(60, $sp, 'Mobile No. : ' . $invoice->client->Mobile_No, 0, 'L', 0);
        $y = $this->fpdf->GetY();
        $this->fpdf->setXY(10, $y);
        $this->fpdf->MultiCell(60, $sp, 'Off. Phone : ' . $invoice->client->Off_Phone, 0, 'L', 0);

        $this->fpdf->SetY(59);
        $y2 = $this->fpdf->GetY();
        $this->fpdf->setXY(75, $y2 + $sp);
        $this->fpdf->MultiCell(60, $sp, iconv('UTF-8', 'windows-1252', $invoice->Ship_Add1) . ' ' . iconv('UTF-8', 'windows-1252', $invoice->Ship_Add2), 0, 'L', 0);
        $y2 = $this->fpdf->GetY();
        $this->fpdf->setXY(75, $y2);
        $this->fpdf->MultiCell(60, $sp, iconv('UTF-8', 'windows-1252', $invoice->Ship_poscode) . ' ' . iconv('UTF-8', 'windows-1252', $invoice->Ship_City), 0, 'L', 0);
        $y2 = $this->fpdf->GetY();
        $this->fpdf->setXY(75, $y2);
        $this->fpdf->MultiCell(60, $sp, $invoice->state->Negeri ?? '', 0, 'L', 0);
        $y2 = $this->fpdf->GetY();
        $this->fpdf->setXY(75, $y2);
        $this->fpdf->MultiCell(60, $sp, $invoice->Ship_Country, 0, 'L', 0);

        $y2 = $this->fpdf->GetY();
        $this->fpdf->setXY(75, $y2);
        $this->fpdf->MultiCell(60, $sp, 'Mobile No. : ' . iconv('UTF-8', 'windows-1252', $invoice->Ship_Phone), 0, 'L', 0);



        if ($y2 > $y)
            $this->fpdf->SetY($y2 + $sp);
        else $this->fpdf->SetY($y + $sp);

        $currY = $this->fpdf->GetY();
    }

    public function products($invoice, &$currY)
    {
        $i = 0;
        // Header
        // foreach($header as $col)
        $this->fpdf->setY($currY);
        $this->fpdf->Cell(10, 7, 'No.', 'BT', 0, 0);
        $this->fpdf->Cell(45, 7, 'Item Code', 'BT', 0, 'L', 0);
        $this->fpdf->Cell(45, 7, 'Particular', 'BT', 0, 'L', 0);
        $this->fpdf->Cell(10, 7, 'Qty', 'BT', 0, 0);
        $this->fpdf->Cell(30, 7, 'U/Price(MYR)', 'BT', 0, 'L', 0);
        $this->fpdf->Cell(30, 7, 'DIS %', 'BT', 0, 'L', 0);
        $this->fpdf->Cell(10, 7, 'Amount(MYR)', 'BT', 0, 'R', 0);
        $this->fpdf->Ln();
        if ($invoice->Product) {
            $i++;
            $this->fpdf->Cell(10, 7, $i, 0,  0, 'C');
            $this->fpdf->Cell(25, 7, $invoice->product->Code ?? "", 0, 0);
            $this->fpdf->Cell(63, 7, $invoice->product->Product_Name ?? "", 0, 0);
            $this->fpdf->Cell(12, 7, $invoice->Qty, 0, 0, 'C');
            $this->fpdf->Cell(30, 7, $invoice->Price, 0, 0);
            $this->fpdf->Cell(30, 7, $invoice->Discount, 0, 0);
            $this->fpdf->Cell(10, 7, $invoice->Total_RM, 0, 0, 'R');
            $this->fpdf->Ln();
        }
        //p1

        if ($invoice->Product_2) {
            $i++;
            $this->fpdf->Cell(10, 7, $i, 0, 0, 'C');
            $this->fpdf->Cell(25, 7, $invoice->product2->Code ?? "", 0, 0);
            $this->fpdf->Cell(63, 7, $invoice->product2->Product_Name ?? "", 0, 0);
            $this->fpdf->Cell(12, 7, $invoice->Qty_2, 0, 0, 'C');
            $this->fpdf->Cell(30, 7, $invoice->Price_2, 0, 0);
            $this->fpdf->Cell(30, 7, $invoice->Discount_2, 0, 0);
            $this->fpdf->Cell(10, 7, $invoice->Total_RM_2, 0, 0, 'R');
            $this->fpdf->Ln();
        }
        //p2
        if ($invoice->Product_3) {
            $i++;
            $this->fpdf->Cell(10, 7, $i, 0, 0, 'C');
            $this->fpdf->Cell(25, 7, $invoice->product3->Code ?? "", 0, 0);
            $this->fpdf->Cell(63, 7, $invoice->product3->Product_Name ?? "", 0, 0);
            $this->fpdf->Cell(12, 7, $invoice->Qty_3, 0, 0, 'C');
            $this->fpdf->Cell(30, 7, $invoice->Price_3, 0, 0);
            $this->fpdf->Cell(30, 7, $invoice->Discount_3, 0, 0);
            $this->fpdf->Cell(10, 7, $invoice->Total_RM_3, 0, 0, 'R');
            $this->fpdf->Ln();
        }
        //p3
        if ($invoice->Product_4) {
            $i++;
            $this->fpdf->Cell(10, 7, $i, 0, 0, 'C');
            $this->fpdf->Cell(25, 7, $invoice->product4->Code ?? "", 0, 0);
            $this->fpdf->Cell(63, 7, $invoice->product4->Product_Name ?? "", 0, 0);
            $this->fpdf->Cell(12, 7, $invoice->Qty_4, 0, 0, 'C');
            $this->fpdf->Cell(30, 7, $invoice->Price_4, 0, 0);
            $this->fpdf->Cell(30, 7, $invoice->Discount_4, 0, 0);
            $this->fpdf->Cell(10, 7, $invoice->Total_RM_4, 0, 0, 'R');
            $this->fpdf->Ln();
        }
        //p4
        if ($invoice->Product_5) {
            $i++;
            $this->fpdf->Cell(10, 7, $i, 0, 0, 'C');
            $this->fpdf->Cell(25, 7, $invoice->product5->Code ?? "", 0, 0);
            $this->fpdf->Cell(63, 7, $invoice->product5->Product_Name ?? "", 0, 0);
            $this->fpdf->Cell(12, 7, $invoice->Qty_5, 0, 0, 'C');
            $this->fpdf->Cell(30, 7, $invoice->Price_5, 0, 0);
            $this->fpdf->Cell(30, 7, $invoice->Discount_5, 0, 0);
            $this->fpdf->Cell(10, 7, $invoice->Total_RM_5, 0, 0, 'R');
            $this->fpdf->Ln();
        }
        //p5
        if ($invoice->Product_6) {
            $i++;
            $this->fpdf->Cell(10, 7, $i, 0, 0, 'C');
            $this->fpdf->Cell(25, 7, $invoice->product6->Code ?? "", 0, 0);
            $this->fpdf->Cell(63, 7, $invoice->product6->Product_Name ?? "", 0, 0);
            $this->fpdf->Cell(12, 7, $invoice->Qty_6, 0, 0, 'C');
            $this->fpdf->Cell(30, 7, $invoice->Price_6, 0, 0);
            $this->fpdf->Cell(30, 7, $invoice->Discount_6, 0, 0);
            $this->fpdf->Cell(10, 7, $invoice->Total_RM_6, 0, 0, 'R');
            $this->fpdf->Ln();
        }
        //p6
        if ($invoice->Product_7) {
            $i++;
            $this->fpdf->Cell(10, 7, $i, 0, 0, 'C');
            $this->fpdf->Cell(25, 7, $invoice->product7->Code ?? "", 0, 0);
            $this->fpdf->Cell(63, 7, $invoice->product7->Product_Name ?? "", 0, 0);
            $this->fpdf->Cell(12, 7, $invoice->Qty_7, 0, 0, 'C');
            $this->fpdf->Cell(30, 7, $invoice->Price_7, 0, 0);
            $this->fpdf->Cell(30, 7, $invoice->Discount_7, 0, 0);
            $this->fpdf->Cell(10, 7, $invoice->Total_RM_7, 0, 0, 'R');
            $this->fpdf->Ln();
        }
        //p7
        if ($invoice->Product_8) {
            $i++;
            $this->fpdf->Cell(10, 7, $i, 0, 0, 'C');
            $this->fpdf->Cell(25, 7, $invoice->product->Code8 ?? "", 0, 0);
            $this->fpdf->Cell(63, 7, $invoice->product->Product_Name8 ?? "", 0, 0);
            $this->fpdf->Cell(12, 7, $invoice->Qty_8, 0, 0, 'C');
            $this->fpdf->Cell(30, 7, $invoice->Price_8, 0, 0);
            $this->fpdf->Cell(30, 7, $invoice->Discount_8, 0, 0);
            $this->fpdf->Cell(10, 7, $invoice->Total_RM_8, 0, 0, 'R');
            $this->fpdf->Ln();
        }
        //p8


        /*  $this->fpdf->Cell(67, 7, 'ZULKIFLY BIN SALLEH', 0, 0);$this->fpdf->Cell(67, 5, 'ZULKIFLY BIN SALLEH', 0, 0);$this->fpdf->Cell(67, 7, 'Invoice No.', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, 7, 'lot15150, bt9 jln bernam', 0, 0);$this->fpdf->Cell(67, 5, 'lot15150, bt9 jln bernam', 0, 0);$this->fpdf->Cell(67, 7, 'Date', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67,7, '45500 tg karang, selangor',0, 0);$this->fpdf->Cell(67, 5, '45500 tg karang, selangor', 0, 0);$this->fpdf->Cell(67, 7, 'Reference', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, 7, 'MALAYSIA', 0, 0);$this->fpdf->Cell(67, 5, 'MALAYSIA', 0, 0);$this->fpdf->Cell(67, 7, 'Terms', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, 7, 'TEL:013 487 4287', 0, 0);$this->fpdf->Cell(67, 5, ' ', 0, 0);$this->fpdf->Cell(67, 7, 'Salesperson', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, 7, 'Account no.18291882', 0, 0);$this->fpdf->Cell(67, 5, ' ', 0, 0);$this->fpdf->Cell(67, 7, 'Page', 0, 0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(67, 7, '', 0, 0);$this->fpdf->Cell(67, 5, ' ', 0, 0);$this->fpdf->Cell(67, 7, 'Promise to pay', 0, 0);
    */
    }
    /*function invoiceDt($header,$data)
        {
            // Header
            foreach($header as $col)
                $this->fpdf->Cell(67,7,$col,0,0);
            //$this->fpdf->Ln();
            // Data
            foreach($data as $invoice)
            {
            // foreach($invoice as $col)

            $this->fpdf->Cell(0,3,'No. 24 & 24-1,'<br>'Jalan Klang Sentral 2/KU5,  Klang Sentral, 41050 KLANG,SELANGOR',0,1,'L');
                    $this->fpdf->Cell(40,6,$invoice,1,0,'R');
                $this->fpdf->Ln();
            }
        }*/
}
