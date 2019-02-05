<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use \PDFShift\PDFShift;

class PDF
{
	public function __construct() {
		PDFShift::setApiKey('apiKey');
	}
	
	public function convert($data,$outputPath) {
		PDFShift::convertTo($data, null, $outputPath);
	}
}
