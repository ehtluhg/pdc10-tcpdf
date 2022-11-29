<?php
require "vendor/autoload.php";

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Set font
        $this->SetFont('DMSans', 'B', 30);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('DMSans', 'I', 8);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gabriel Dy');
$pdf->SetTitle('TCPDF 007');
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

// set font
$pdf->SetFont('DMSans', 'B', 20);

// --- first page ------------------------------------------

// add a page
$pdf->AddPage();

// set colors for gradients (r,g,b) or (grey 0-255)
$first = array(239, 35, 60);
$second = array(115, 186, 155);
$third = array(0, 62, 31);
$fourth = array(217, 4, 41);
$white = array(213, 242, 227);
$black = array(0);

$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,20,5,10', 'phase' => 10, 'color' => array(255, 0, 0));
$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 62, 31));
$style3 = array('width' => 1, 'cap' => 'round', 'join' => 'round', 'dash' => '2,10', 'color' => array(255, 0, 0));
$style4 = array(
    'L' => 0,
    'T' => array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '20,10', 'phase' => 10, 'color' => array(100, 100, 255)),
    'R' => array('width' => 0.50, 'cap' => 'round', 'join' => 'miter', 'dash' => 0, 'color' => array(50, 50, 127)),
    'B' => array('width' => 0.75, 'cap' => 'square', 'join' => 'miter', 'dash' => '30,10,5,10')
);
$style5 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 62, 31));
$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,10', 'color' => array(0, 128, 0));
$style7 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(217, 4, 41));


// first patch: f = 0
$patch_array[0]['f'] = 0;
$patch_array[0]['points'] = array(
    0.00, 0.00, 0.33, 0.00,
    0.67, 0.00, 1.00, 0.00, 1.00, 0.33,
    0.8, 0.67, 1.00, 1.00, 0.67, 0.8,
    0.33, 1.80, 0.00, 1.00, 0.00, 0.67,
    0.00, 0.33
);
$patch_array[0]['colors'][0] = array('r' => 255, 'g' => 255, 'b' => 0);
$patch_array[0]['colors'][1] = array('r' => 0, 'g' => 0, 'b' => 255);
$patch_array[0]['colors'][2] = array('r' => 0, 'g' => 255, 'b' => 0);
$patch_array[0]['colors'][3] = array('r' => 255, 'g' => 0, 'b' => 0);

// second patch - above the other: f = 2
$patch_array[1]['f'] = 2;
$patch_array[1]['points'] = array(
    0.00, 1.33,
    0.00, 1.67, 0.00, 2.00, 0.33, 2.00,
    0.67, 2.00, 1.00, 2.00, 1.00, 1.67,
    1.5, 1.33
);
$patch_array[1]['colors'][0] = array('r' => 0, 'g' => 0, 'b' => 0);
$patch_array[1]['colors'][1] = array('r' => 255, 'g' => 0, 'b' => 255);

// third patch - right of the above: f = 3
$patch_array[2]['f'] = 3;
$patch_array[2]['points'] = array(
    1.33, 0.80,
    1.67, 1.50, 2.00, 1.00, 2.00, 1.33,
    2.00, 1.67, 2.00, 2.00, 1.67, 2.00,
    1.33, 2.00
);
$patch_array[2]['colors'][0] = array('r' => 0, 'g' => 255, 'b' => 255);
$patch_array[2]['colors'][1] = array('r' => 0, 'g' => 0, 'b' => 0);

// fourth patch - below the above, which means left(?) of the above: f = 1
$patch_array[3]['f'] = 1;
$patch_array[3]['points'] = array(
    2.00, 0.67,
    2.00, 0.33, 2.00, 0.00, 1.67, 0.00,
    1.33, 0.00, 1.00, 0.00, 1.00, 0.33,
    0.8, 0.67
);
$patch_array[3]['colors'][0] = array('r' => 0, 'g' => 0, 'b' => 0);
$patch_array[3]['colors'][1] = array('r' => 0, 'g' => 0, 'b' => 255);

// paint a coons patch mesh with default coordinates
$pdf->CoonsPatchMesh(0.2, 0, 260, 400, $first, $second, $third, $fourth);


// Star polygon
$pdf->SetLineStyle($style5);
$pdf->StarPolygon(105, 70, 15, 12, 5, 30, 0, 'DF', array('all' => $style7), array(220, 220, 200), 'F', array(217, 4, 41));
$pdf->StarPolygon(150, 70, 15, 12, 5, 30, 0, 'DF', array('all' => $style5), array(220, 220, 200), 'F', array(0, 62, 31));
$pdf->StarPolygon(60, 70, 15, 12, 5, 30, 0, 'DF', array('all' => $style2), array(220, 220, 200), 'F', array(217, 4, 41));


$pdf->SetFont('DMSans', '', 15);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 0, 'BSIT-3A warmly greets you a...', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

$pdf->SetFont('AppleGaramond', 'B', 90);
$pdf->MultiCell(150, 0, "Happy Holidays!", 0, 'C', 0, 1, 30, 95, true, 0);
$pdf->SetFont('DMSans', '', 13);
$pdf->Ln(10);
$pdf->MultiCell(120, 10, "Wishing you all peace and joy this holiday season!", 0, 'C', 0, 1, 45, 255, true, 0);

$pdf->StarPolygon(60, 210, 15, 12, 5, 30, 0, 'DF', array('all' => $style7), array(220, 220, 200), 'F', array(217, 4, 41));
$pdf->StarPolygon(105, 210, 15, 12, 5, 30, 0, 'DF', array('all' => $style5), array(220, 220, 200), 'F', array(0, 62, 31));
$pdf->StarPolygon(150, 210, 15, 12, 5, 30, 0, 'DF', array('all' => $style7), array(220, 220, 200), 'F', array(0, 62, 31));

// ---------------------------------------------------------

// Close and output PDF document
$pdf->Output('example-7.pdf');

//============================================================+
// END OF FILE
//============================================================+