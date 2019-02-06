# How to use PHPMailer 

## Installing 
To install it with composer: `composer require phpmailer/phpmailer`  
Other ways are describen on [packagist](https://packagist.org/packages/phpmailer/phpmailer)

## Example 
### Email Class 
The class Email could look like [this](https://github.com/samuelgfeller/documentation/blob/master/PHPMailer/Email.php)
### Use of the class
```php
$mail = new Email();
ob_start();
include __DIR__ . '/templates/success/confirmation_mail.php';
$mailBody = ob_get_clean();
$mail->prepare('Order for the ' . date('d.m.Y', strtotime($_POST['date'])), $mailBody);
$mail->send($client->getEmail(), 'info@domain.com', $client->getFirstName() . ' ' . $client->getName(), 'CompanyName');
```
