	//Filling variables 
  // ...
  // Get content
  ob_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bill/bill_absolute.html.php';
	$pdfBody = ob_get_clean();
//	var_dump($pdfBody);

//	echo $pdfBody; die();
//Instantiate the class
    $html2pdf = new pdflayer();

//set the URL to convert
    $html2pdf->set_param('margin_top', 0);
    $html2pdf->set_param('margin_bottom', 0);
    $html2pdf->set_param('margin_left', 0);
    $html2pdf->set_param('margin_right', 0);

    $html2pdf->set_param('document_html',$pdfBody);


//start the conversion
    $html2pdf->convert();
    
//    $html2pdf->display_pdf();
	$attachmentUrl = $_SERVER['DOCUMENT_ROOT'] . '/templates/bill/temp/bill.pdf';
	file_put_contents ( $attachmentUrl,$html2pdf->pdf);
	
    $mail = new Email();
    $mail->prepare('Testmail', '<h1>this is a test</h1>',$attachmentUrl);
    $mail->send('samuelgfeller@bluewin.ch', 'info@masesselin.ch', 'Test', 'Masesselin');
	unlink($attachmentUrl); // Delete file
