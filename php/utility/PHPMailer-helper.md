# PHPMailer helper class
I created this class to work with [PHPMailer](https://github.com/PHPMailer/PHPMailer) because I had one with [mailgun/mailgun-php](https://github.com/mailgun/mailgun-php) 
but I realized that it was kind of useless as PHPMailer 
already provides simple functions to call. 
I will use PHPMailer directly where I need to send an email and I recommend to do so but here is the work I did (for nothing).
  
`Email.php`
```php
<?php

namespace App\Domain\Utility;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public function __construct(private PHPMailer $mailer)
    {
    }

    /**
     * Add subject and message body to mailer
     *
     * @param string $subject
     * @param string $message
     */
    public function addContent(string $subject, string $message): void
    {
        $this->mailer->isHTML(); // Default is plain text

        $this->mailer->Subject = $subject;
        $this->mailer->Body = $message;
        $this->mailer->AltBody = strip_tags($message);
    }

    /**
     * Add an attachment from a path on the filesystem.
     *
     * @param string $attachmentPath
     * @param string $name
     * @return bool Returns false if the file could not be found or read.
     * @throws Exception
     *
     */
    public function addAttachment(string $attachmentPath, $name = ''): bool
    {
        return $this->mailer->addAttachment($attachmentPath, $name);
    }

    /**
     * Set sender and replyTo address
     *
     * @param string $from
     * @param string $fromName
     * @param string|null $replyTo
     * @param string $replyToName
     * @throws Exception
     */
    public function setFrom(string $from, string $fromName = '', string $replyTo = null, string $replyToName = ''): void
    {
        $this->mailer->setFrom($from, $fromName);
        if ($replyTo !== null) {
            $this->mailer->addReplyTo($replyTo, $replyToName);
        }
    }

    /**
     * @param string $toAddress
     * @param string $toName
     *
     * @return bool
     *
     * @throws Exception
     */
    public function sendTo(string $toAddress, string $toName = ''): bool
    {
        $this->mailer->addAddress($toAddress, $toName);     //Add a recipient

        return $this->mailer->send();
    }

    /**
     * Send to multiple addresses
     *
     * Params in assoc array to make sure that right name belongs to address. Since names are optional there could be
     * addresses but not names so if they were in different arrays the length might not be the same.
     * @param array $toAddressesAndNames [['address' => 'string', 'name' => 'optional']]
     * @param array $ccAddressesAndNames [['address' => 'string', 'name' => 'optional']]
     * @param array $bccAddressesAndNames [['address' => 'string', 'name' => 'optional']]
     *
     * @return bool
     * @throws Exception
     */
    public function sendToMultiple(
        array $toAddressesAndNames,
        array $ccAddressesAndNames = [],
        array $bccAddressesAndNames = []
    ): bool {
        foreach ($toAddressesAndNames as $to) {
            $this->mailer->addAddress($to['address'], $to['name'] ?? '');
        }
        foreach ($ccAddressesAndNames as $cc) {
            $this->mailer->addCC($cc['address'], $cc['name'] ?? '');
        }
        foreach ($bccAddressesAndNames as $bcc) {
            $this->mailer->addBCC($bcc['address'], $bcc['name'] ?? '');
        }

        return $this->mailer->send();
    }
}
```
