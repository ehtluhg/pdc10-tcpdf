<?php

require "vendor/autoload.php";

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'B', 30);
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
$pdf->SetTitle('TCPDF 005');
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

// add a page
$pdf->AddPage();

// set default font subsetting mode
$pdf->setFontSubsetting(false);

$pdf->SetFont('AppleGaramond-BoldItalic', '', 45);

$pdf->Write(5, 'My Favorite Quotes', '', 0, 'C', 1, 0, false, false, 0);

$pdf->Ln(14);

$pdf->SetFont('AppleGaramond-BoldItalic', '', 15);

$pdf->MultiCell(300, 0, "Gon, You Are Light. But Sometimes You Shine So Brightly, I Must Look Away.\nEven So, Is It Still Okay If I Stay At Your Side?\n- Killua Zoldyck\n", 0, 'J', 0, 1, '', '', true, 0);

$pdf->Ln(12);

$pdf->SetFont('AppleGaramond-LightItalic', '', 15);

$pdf->MultiCell(300, 0, "I Do Not Fear Death. I Fear Only That My Rage Will Fade Over Time.\n- Kurapika Kurta\n", 0, 'J', 0, 1, '', '', true, 0);

$pdf->Ln(12);

$pdf->SetFont('AppleGaramond-Italic', '', 15);

$pdf->MultiCell(300, 0, "You Should Enjoy The Little Detours To The Fullest, Because Thats Where You'll Find Things\nMore Important Than What You Want.\n- Ging Freecss\n", 0, 'J', 0, 1, '', '', true, 0);


// ---------------------------------------------------------

// Close and output PDF document
$pdf->Output('example-5.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+