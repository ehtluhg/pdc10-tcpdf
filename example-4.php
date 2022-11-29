<?php
require "vendor/autoload.php";

// Parse
$csv_file = 'data2022.csv';
$handle = fopen($csv_file, 'r');
$row_index = 0; // initialize
$headers = [];
$data = [];
$barcode = [];

while (($row_data = fgetcsv($handle, 1000, ',')) !== FALSE) {
	if ($row_index++ < 1) {
		foreach ($row_data as $col) {
			array_push($headers, $col);
		}
		continue;
	}

	$tmp = [];
	for ($index = 0; $index < count($headers); $index++) {
		$tmp[$headers[$index]] = $row_data[$index];
	}
	array_push($data, $tmp);
}

fclose($handle);
// End of Parse

class MYPDF extends TCPDF
{
	function BasicTable($header, $data)
	{
		// Header
		foreach ($header as $col)
			$this->Cell(38, 15, $col, 1, 0, 'C');
			$this->Ln();
		// Data
		foreach ($data as $row) {
			$country_code = array_slice($row, 1, 1, true);

			foreach ($row as $col)
				$this->Cell(38, 38, $col, 1, 0, 'C');
				$x = $this->GetX();
				$y = $this->GetY();

			foreach ($country_code as $code)
				$brstyle = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					'border' => true,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0, 0, 0),
					'bgcolor' => false,
					'text' => true,
					'font' => 'DMSans',
					'fontsize' => 11,
					'stretchtext' => 6
				);

				$qrstyle = array(
					'border' => 2,
					'vpadding' => 'auto',
					'hpadding' => 'auto',
					'fgcolor' => array(0, 0, 0),
					'bgcolor' => false,
					'module_width' => 1,
					'module_height' => 1
				);

			$this->write1DBarcode($code, 'C39E', '', '', 38, 38, 0.40, $brstyle, '');
			$this->write2DBarcode($code, 'QRCODE,L', $x + 38, $y, 38, 38, $qrstyle, '', true);
			$this->Ln();
		}
	}
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$header = array('ID', 'Country', 'Population', 'Barcode', 'QR Code');
$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->SetFont('DMSans', '', 12);
$pdf->AddPage();
$pdf->BasicTable($header, $data);
$pdf->Output('example-4.pdf');
