<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Route;

class DocketController extends Controller
{
    //## Docket Template Configuration ###
    //~by AwakComey
    //~last update on 20th February 2018
    //~to adjust docket part position, setting X-axis & Y-axis number
    // x-axis will be left or right
    // y-axis will be up and down
    // docket divided by 6 part
    //~last update on 30th Mar 2018

    /********************DOCKET POSLAJU EXAMPLE 2018 **************************/

    //###########################################################################
    //      PART 1 COMPANY NAME                                                 #
    //      COMPANY CONTACT                                                     #
    //      COMPANY EMAIL                      PART 5 PRODUCTS                  #
    //---------------------------------------------------- PART 6 CONS NAME ----#
    //   PART 2 CLIENT NAME                                DATE                 #
    //   ADDRESS & ROAD NAME                                                    #
    //--------------------------------------------------------------------------#
    //      PART 3 CITY                                                         #
    //      STATE                                                               #
    //      CLIENT CONTACT                                                      #
    //--------------------------------------------------------------------------#
    //                                PART 4 POSCODE                            #
    //###########################################################################

    //#### Part 1 #######
    //$x1 =0; $y1 = 4;
    private $x1 = 0;

    private $y1 = 4;

    //#### Part 2 #######
    //$x2 =0; $y2 = 0;
    private $x2 = 0;

    private $y2 = 4;

    //#### Part 3 #######
    private $x3 = 0;

    private $y3 = 6;
    //$x3 =0; $y3 = 0;

    //#### Part 4 #######
    private $x4 = 17;

    private $y4 = 0;
    //$x4 =13; $y4 = 2;

    //#### Part 5 #######
    //$x5 =0; $y5 = 0;
    private $x5 = 8;

    private $y5 = -2;

    //#### Part 6 #######
    //$x6 =0; $y6 = 6;
    private $x6 = 23;

    private $y6 = 3;
    //###################

    protected $fpdf;

    protected $portfolio;

    protected $company_name;

    public function __construct()
    {
        $this->fpdf = new Fpdf('L', 'mm', [100, 240]);
        $this->portfolio = Route::current() ? Route::current()->parameter('portfolio') : '';
    }

    public function print($portfolio, $id)
    {
        $invoice = Invoice::find($id);

        $this->generatePage($invoice);

        $this->fpdf->Output();

        exit;
    }

    public function printDockets($invoices)
    {
        foreach ($invoices as $invoice) {
            $this->generatePage($invoice);
        }

        $this->fpdf->Output();

        exit;
    }

    public function generatePage($invoice)
    {
        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage();
        //$this->fpdf->SetMargins(0,0,0);\
        $this->Header();
        $this->fpdf->SetAutoPageBreak(false, 0);
        $this->bill($invoice);
        //$this->fpdf->billDeliver($header,$rows,$currY);
        $this->fpdf->Ln();

        try {
            Invoice::where('Id', $invoice->Id)->update(['Docket_Status' => 1]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // Page header
    private function Header()
    {

        // Arial bold 15
        $this->fpdf->SetFont('Arial', '', 10);

        // COMPANY NAME

        $this->fpdf->SetXY(10 + $this->x1, 16 + $this->y1);
        $this->fpdf->Cell(98, 10, 'IMPERIA ASIA RESOURCES (SA017174-U)', 0, 1, 'C');

        $this->fpdf->SetXY(10 + $this->x1, 22 + $this->y1);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(98, 4, 'Wisma Imperia Asia No.24,', 0, 0, 'C');
        $this->fpdf->SetXY(10 + $this->x1, 25 + $this->y1);
        $this->fpdf->Cell(98, 4, 'Jalan Klang Sentral 2/KU5,', 0, 0, 'C');
        $this->fpdf->SetXY(10 + $this->x1, 28 + $this->y1);
        $this->fpdf->Cell(98, 4, 'Klang Sentral, 41050 Klang, Selangor.', 0, 0, 'C');
        $this->fpdf->SetXY(10 + $this->x1, 31 + $this->y1);
        $this->fpdf->Cell(98, 5, 'Tel : +603-3341 9822 / +6016 447 1982 / 1 800 88 1982', 0, 1, 'C');
        $this->fpdf->SetXY(10 + $this->x1, 34 + $this->y1);
        $this->fpdf->Cell(98, 5, 'E-Mail : hi@imperiaasia.com Website : www.imperiaasia.com', 0, 1, 'C');
        // Line break +603-3341 9822

        $this->fpdf->Ln(20);
    }

    private function bill($row)
    {
        $this->fpdf->SetFont('Arial', '', 9);
        //$this->SetFont('Arial','B',7);

        //###### part 6  Consultant name & date #########

        $this->fpdf->SetXY(10 + $this->x6, -55 + $this->y6);
        $this->fpdf->Cell(180, 4, $row->consultant?->Nickname, 0, 0, 'R');

        $this->fpdf->SetXY(10 + $this->x6, -50 + $this->y6);
        $this->fpdf->Cell(180, 4, $row->Date, 0, 0, 'R');

        $this->fpdf->SetFont('Arial', '', 12);

        $this->fpdf->SetXY(10 + $this->x6, -10 + $this->y6);
        $this->fpdf->Cell(180, 4, $row->Inv_No, 0, 0, 'R');
        $this->fpdf->SetFont('Arial', '', 8);

        //###### part 2 client name & address #########

        $this->fpdf->SetY(-44 + $this->y2);
        $this->fpdf->SetX(1 + $this->x2);
        $this->fpdf->Cell(75, 4, iconv('UTF-8', 'windows-1252', $row->Ship_Name), 0, 0, 'L');

        $this->fpdf->SetY(-40 + $this->y2);
        $this->fpdf->SetX(1 + $this->x2);
        $this->fpdf->MultiCell(120, 4, iconv('UTF-8', 'windows-1252', $row->Ship_Add1).' '.iconv('UTF-8', 'windows-1252', $row->Ship_Add2), 0, 'L', 0);

        //###### part 3 city, state, phone no #########

        $this->fpdf->SetFont('Arial', '', 8);
        $this->fpdf->SetXY(10 + $this->x3, -29 + $this->y3); //originally -25
        $this->fpdf->MultiCell(60, 4, '      '.iconv('UTF-8', 'windows-1252', $row->Ship_City), 0, 'L', 0);

        $this->fpdf->SetXY(10 + $this->x3, -26 + $this->y3); //originally -22
        $this->fpdf->MultiCell(60, 4, '      '.$row->state?->Negeri.' '.$row->Ship_Country, 0, 'L', 0);

        $this->fpdf->SetXY(10 + $this->x3, -22 + $this->y3); //originally -18
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell(100, 4, '      Mobile No. : '.iconv('UTF-8', 'windows-1252', $row->Ship_Phone).'/'.iconv('UTF-8', 'windows-1252', $row->Off_Phone), 0, 'L', 0);

        $this->fpdf->SetFont('times', 'B', 18);

        //###### part 4  poscode #########

        $this->fpdf->SetXY(10 + $this->x4, -9 + $this->y4); //originally -5

        $a = substr($row->Ship_poscode, 0, 1);
        $b = substr($row->Ship_poscode, 1, 1);
        $c = substr($row->Ship_poscode, 2, 1);
        $d = substr($row->Ship_poscode, 3, 1);
        $e = substr($row->Ship_poscode, 4, 1);
        $this->fpdf->MultiCell(115, 4, ' '.$a.'   '.$b.'    '.$c.'    '.$d.'    '.$e, 0, 'R', 0);

        $this->prod($row);
    }

    private function prod($row)
    {
        $pro = $row->Qty.substr($row->product?->Code, 0, 1);

        if ($row->product2?->Code != 'POSLAJU' && $row->product2?->Code != 'ADJUSTMENT' && $row->product2?->Code != 'TRANSPORTATION CHARGE' && $row->product2?->Code != null) {
            if ($row->product2?->Code == 'FREEGIFT') {
                $pro .= '+FG';
            } else {
                $pro .= ','.$row->Qty_2.substr($row->procode2, 0, 1);
            }
        }

        if ($row->product3?->Code != 'POSLAJU' && $row->product3?->Code != 'ADJUSTMENT' && $row->product3?->Code != 'TRANSPORTATION CHARGE' && $row->product3?->Code != null) {
            if ($row->product3?->Code == 'FREEGIFT') {
                $pro .= '+FG';
            } else {
                $pro .= ','.$row->Qty_3.substr($row->product3?->Code, 0, 1);
            }
        }

        if ($row->product4?->Code != 'POSLAJU' && $row->product4?->Code != 'ADJUSTMENT' && $row->product4?->Code != 'TRANSPORTATION CHARGE' && $row->product4?->Code != null) {
            if ($row->product4?->Code == 'FREEGIFT') {
                $pro .= '+FG';
            } else {
                $pro .= ','.$row->Qty_4.substr($row->product4?->Code, 0, 1);
            }
        }

        if ($row->product5?->Code != 'POSLAJU' && $row->product5?->Code != 'FREEGIFT' && $row->product5?->Code != 'ADJUSTMENT' && $row->product5?->Code != 'TRANSPORTATION CHARGE' && $row->product5?->Code != null) {
            if ($row->product5?->Code == 'FREEGIFT') {
                $pro .= '+FG';
            } else {
                $pro .= ','.$row->Qty_5.substr($row->product5?->Code, 0, 1);
            }
        }

        if ($row->product6?->Code != 'POSLAJU' && $row->product6?->Code != 'ADJUSTMENT' && $row->product6?->Code != 'TRANSPORTATION CHARGE' && $row->product6?->Code != null) {
            if ($row->product6?->Code == 'FREEGIFT') {
                $pro .= '+FG';
            } else {
                $pro .= ','.$row->Qty_6.substr($row->product6?->Code, 0, 1);
            }
        }

        if ($row->product7?->Code != 'POSLAJU' && $row->product7?->Code != 'ADJUSTMENT' && $row->product7?->Code != 'TRANSPORTATION CHARGE' && $row->product7?->Code != null) {
            if ($row->product7?->Code == 'FREEGIFT') {
                $pro .= '+FG';
            } else {
                $pro .= ','.$row->Qty_7.substr($row->product7?->Code, 0, 1);
            }
        }

        if ($row->product8?->Code != 'POSLAJU' && $row->product8?->Code != 'ADJUSTMENT' && $row->product8?->Code != 'TRANSPORTATION CHARGE' && $row->product8?->Code != null) {
            if ($row->product8?->Code == 'FREEGIFT') {
                $pro .= '+FG';
            } else {
                $pro .= ','.$row->Qty_8.substr($row->product8?->Code, 0, 1);
            }
        }

        //###### part 5 product #########
        $this->fpdf->SetFont('times', 'B', 8);
        $this->fpdf->SetXY(22 + $this->x5, 34 + $this->y5);
        $this->fpdf->Cell(125, 5, 'Minuman Botani Kurma', 0, 1, 'R');
        $this->fpdf->SetFont('times', 'B', 10);
        $this->fpdf->SetXY(10 + $this->x5, 38 + $this->y5);
        $this->fpdf->Cell(125, 5, $pro, 0, 1, 'R');
    }
}
