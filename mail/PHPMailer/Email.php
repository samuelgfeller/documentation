<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/Local.php';

class Email
{
	protected $mail;
	
	public function __construct() {
		$this->mail = new PHPMailer(true);                // Passing `true` enables exceptions
		//Server settings
		$this->mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = Local::mailhost;                    // Specify main and backup SMTP servers
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = 'no-reply@masesselin.ch';           // SMTP username
		$this->mail->Password = Local::mailpasswd;                   // SMTP password
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

    public function save_mail() {
        //You can change 'Sent Mail' to any other folder or tag
        $path = "{srv125.tophost.ch:993/imap/ssl}INBOX.Sent";
        //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
        $imapStream = imap_open($path, $this->mail->Username, $this->mail->Password);
        //You can use imap_getmailboxes($imapStream, '/imap/ssl') to retrieve a list of available folders or labels.
        //Can be useful if you are trying to get this working on a non-Gmail IMAP server.
        $result = imap_append($imapStream, $path, $this->mail->getSentMIMEMessage());
        imap_close($imapStream);
        return $result;
    }
	public function send($to, $replyTo, $toName = false, $replyToName = false) {
		try {
			//Recipients
			$this->mail->setFrom('no-reply@masesselin.ch', 'Masesselin');
			$this->mail->addReplyTo($replyTo, $replyToName ?? $replyTo);
			$this->mail->addAddress($to, $toName ?? $to);
			$this->mail->send();
            $this->save_mail();
		} catch
		(Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
		}
	}
}
