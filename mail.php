<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'C:\Users\Admin\Zaki\Coding_Stuff\PHP\Xampp\htdocs\PHPMailer\vendor\autoload.php';

$mail = new PHPMailer();

$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = 2;

//Set the hostname of the mail server
$mail->Host = 'smtp.mailgun.org';
//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = 587;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'postmaster@mg.iskoline.live';

//Password to use for SMTP authentication
$mail->Password = 'e8990d893967db5ae3973d6e4a73aa77-523596d9-36d15db0';

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom('dict2.1.teamone@gmail.com', 'Navitopia');

// //Set an alternative reply-to address
// //This is a good place to put user-submitted addresses
// $mail->addReplyTo('replyto@example.com', 'First Last');

// //Set who the message is to be sent to
// $mail->addAddress('whoto@example.com', 'John Doe');

// //Set the subject line
// $mail->Subject = 'PHPMailer GMail SMTP test';


// $mail->isHTML(true);                                  //Set email format to HTML
// $mail->Subject = 'Here is the subject';
// $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

// //Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';

// //Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

// //send the message, check for errors
// if (!$mail->send()) {
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message sent!';
//     //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
// }
