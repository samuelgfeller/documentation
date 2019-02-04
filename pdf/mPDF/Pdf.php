<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class Pdf
{
	protected $pdf;
	
	public function __construct() {
		try {
			$config = [
				'mode' => 'utf-8',
				'format' => 'A4',
				'fontDir' => $_SERVER['DOCUMENT_ROOT'] . '/public/fonts',
				'fontdata' => [
					'helvetica' => [
						'R' => 'Helvetica.ttf',
						'B' => 'Helvetica-Bold.ttf',
					]
				],
				'default_font' => 'Helvetica',
				'margin_left' => 0,
				'margin_right' => 0,
				'margin_top' => 0,
				'margin_bottom' => 0,
				'margin_header' => 0,
				'margin_footer' => 0,
				'watermarkImgBehind' => true,
				'shrink_tables_to_fit' => 1,
			];
			$this->pdf = new \Mpdf\Mpdf($config);
			$this->pdf->debug = true;
//			$this->pdf->shrink_tables_to_fit = 3;
            $this->pdf->useFixedNormalLineHeight = false;
            $this->pdf->useFixedTextBaseline = false;
//            $this->pdf->adjustFontDescLineheight = 0.1;

		} catch (\Mpdf\MpdfException $e) {
			die('Error with Mpdf ' . $e);
		}
	}
	
	public function writeHTML($html): void {
		try {
			$this->pdf->WriteHTML($html);
		} catch (\Mpdf\MpdfException $e) {
			echo $e;
		}
	}
	
	public function setWatermark($path) {
		$this->pdf->SetWatermarkImage($path,1,'D','P');
		$this->pdf->showWatermarkImage = true;
	}
	
	public function getPdfAsAttachment() {
		try {
			return $this->pdf->Output('', 'S');
		} catch (\Mpdf\MpdfException $e) {
			echo $e;
			return false;
		}
	}
	
	public function outputPdfToBrowser(): void {
		try {
			$this->pdf->Output('Rechnung.pdf', 'I');
		} catch (\Mpdf\MpdfException $e) {
			echo $e;
		}
	}
}
