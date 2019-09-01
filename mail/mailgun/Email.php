<?php
//I DIDN'T TRY IT OUT SO IT PROBABLY WONT WORK LIKE THIS!!!

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use Mailgun\Mailgun;

//Load Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/Local.php';
class MailgunTest {
    protected $mail;

    public function __construct() {
        $this->mail = Mailgun::create('key-example', 'https://api.eu.mailgun.net');
    }

    public function sendEmail($from,$fromName,$to,$toName,$subject,$message){
// $mg->messages()->send($domain, $params);
        $this->mail->messages()->send('masesselin.ch', [
            'from'    => $fromName.' <'.$from.'>',
            'to'      => $to.' <'.$toName.'>',
            'subject' => $subject,
            'text'    => $message,
        ]);
    }

}

