# How to create and send a PDF in a Mail using php

## Why PDFShift?
The reason why I use and recommend https://pdfshift.io is because I tried many html-pdf converter and none of them worked properly with my css.
I use position absolute and min-height ect. I spent hours changing and searching alternatives to my css but the result was always that it 
didn't work properly and I was desperate. When I came accross pdfshift I could use my first, with no modification html + css and it worked
perfectly with the fonts! The only thing is that it is not free... But I guess for the benefits it is worth spending a bit money.

## Create and send PDF 

### Installation of PDFShift
First of all you have to install PDFShift. They explain very well how [here](https://github.com/pdfshift/pdfshift-php).   
Basically it is only `composer require pdfshift/pdfshift-php` and then one way to use it, is to create a class which calls 
the PDFShift methods like 
[this](https://github.com/samuelgfeller/documentation/blob/master/pdf/PDFShift/PDF.php).

### Installation of PHPMailer
[Here](https://github.com/samuelgfeller/documentation/blob/master/PHPMailer/use_case_with_example.md) 
is a short article on how to install PHPMailer

### Example to send a mail with an attachment created with PDFShift
[PDF.php](https://github.com/samuelgfeller/documentation/blob/master/pdf/PDFShift/PDF.php)  
[Email.php](https://github.com/samuelgfeller/documentation/blob/master/PHPMailer/Email.php)

```php 
// Get HTML 
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bill/bill_pdf.html.php';
$pdfBody = ob_get_clean();

$attachmentPath = $_SERVER['DOCUMENT_ROOT'] . '/templates/bill/temp/bill.pdf';

// Instantiating the PDF
$pdf = new PDF();
// Convert the HTML to PDF
$pdf->convert($pdfBody, $attachmentPath);

// Create an instance of Email.php
$mail = new Email();
$mailBody = 'This is an example test mail.';
// Prepare email
$mail->prepare('Bill from ' . date('d.m.Y'), $mailBody, $attachmentPath, 'Bill.pdf');
// Send email
$mail->send('to@domain.com', 'info@domain.com', 'toName', 'CompanyName');
unlink($attachmentPath); // Delete file


---
### Source
https://pdfshift.io
https://github.com/pdfshift/pdfshift-php
https://github.com/PHPMailer/PHPMailer
My experience


