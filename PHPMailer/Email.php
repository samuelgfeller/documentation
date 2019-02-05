<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class Email
{
	protected $mail;
	
	public function __construct() {
		$this->mail = new PHPMailer(true);                          // Passing `true` enables exceptions
		//Server settings
		$this->mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'host.address';                         // Specify main and backup SMTP servers
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = 'no-reply@masesselin.ch';           // SMTP username
		$this->mail->Password = '***';                              // SMTP password
		$this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$this->mail->Port = 587;
		$this->mail->CharSet = 'UTF-8';
		$this->mail->Encoding = 'base64';
	}
	
	/**
	 * @param $subject
	 * @param $message
	 * @param bool $attachment
	 * @param string $attachmentName
	 * @throws Exception
	 */
	public function prepare($subject, $message,$attachment = false,$attachmentName = '') {
		//Content
		$this->mail->isHTML(true);                                  // Set email format to HTML
		$this->mail->Subject = $subject;
		$this->mail->Body = $message;
		$this->mail->AltBody = strip_tags($message);
        $attachment ? $this->mail->addAttachment($attachment, $attachmentName) : null;    // Optional name
	}
	
	public function send($to, $replyTo, $toName = false, $replyToName = false) {
		try {
			//Recipients
			$this->mail->setFrom('no-reply@domain.com', 'Name');
			$this->mail->addReplyTo($replyTo, $replyToName ?? $replyTo);
			$this->mail->addAddress($to, $toName ?? $to);
			$this->mail->send();
		} catch
		(Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
		}
	}


}
