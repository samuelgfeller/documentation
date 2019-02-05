<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use \PDFShift\PDFShift;

class PDF
{
	public function __construct() {
		PDFShift::setApiKey('4f00ae5be5b34b5995ac110c719e6d7c');
	}
	
	public function convert($data,$outputPath) {
		PDFShift::convertTo($data, null, $outputPath);
	}
}
