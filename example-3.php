<?php
require "vendor/autoload.php";

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Set font
        $this->SetFont('AppleGaramond', 'B', 30);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('AppleGaramond', '', 6);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gabriel Dy');
$pdf->SetTitle('TCPDF 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// set font
$pdf->SetFont('AppleGaramond', '', 12);

// add a page
$pdf->AddPage();

// get esternal file content
$chapter1 = file_get_contents('vendor/tecnickcom/tcpdf/examples/data/chapter-1.txt', false);
$chapter2 = file_get_contents('vendor/tecnickcom/tcpdf/examples/data/chapter-2.txt', false);
$chapter3 = file_get_contents('vendor/tecnickcom/tcpdf/examples/data/chapter-3.txt', false);

// set color for text
$pdf->SetTextColor(51, 53, 51);

// write the text
$pdf->Write(5, $chapter1, '', 0, '', false, 0, false, false, 0);
$pdf->Write(5, $chapter2, '', 0, '', false, 0, false, false, 0);
$pdf->Write(5, $chapter3, '', 0, '', false, 0, false, false, 0);


// ---------------------------------------------------------

// Close and output PDF document
$pdf->Output('example-3.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+