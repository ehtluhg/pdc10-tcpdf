<?php
require "vendor/autoload.php";

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'B', 30);
        // Title
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gabriel Dy');
$pdf->SetTitle('TCPDF 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('DMSans', 'B', 45);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'January 2023', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('DMSans', '', 8);

// -----------------------------------------------------------------------------


$tbl = <<<EOD
<table border="0" cellpadding="9" cellspacing="9" align="center">
 <tr nobr="true">
  <th colspan="7"></th>
 </tr>
 <tr nobr="true">
  <td>Sunday</td>
  <td>Monday</td>
  <td>Tuesday</td>
  <td>Wednesday</td>
  <td>Thursday</td>
  <td>Friday</td>
  <td>Saturday</td>
 </tr>
 <tr nobr="true">
  <td style="background-color: #2f4550;color:#b8dbd9">  1<span style="color:#f4f4f9;font-size: 6pt;"><br><br>New Year's Day</span></td>
  <td style="background-color: #586f7c;color:#f4f4f9">  2<span style="color:#b8dbd9;font-size: 3.5pt;"><br><br><br>(Special Non-Working Day)</span></td>
  <td>3</td>
  <td>4</td>
  <td>5</td> 
  <td>6</td>
  <td>7</td>
  
 </tr>
 <tr nobr="true">
  <td>8</td>
  <td>9</td>
  <td>10</td>
  <td>11</td>
  <td>12</td>
  <td>13</td>
  <td>14</td>
 </tr>
 <tr nobr="true">
  <td>15</td>
  <td>16</td>
  <td>17</td>
  <td>18</td>
  <td>19</td>
  <td>20</td>
  <td>21</td>
 </tr>
 <tr nobr="true">
  <td>22</td>
  <td>23</td>
  <td>24</td>
  <td>25</td>
  <td>26</td>
  <td>27</td>
  <td>28</td>
 </tr>
 <tr nobr="true">
  <td>29</td>
  <td>30</td>
  <td>31</td>
  <td></td>
  <td></td>
 </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

// Close and output PDF document
$pdf->Output('example-6.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
