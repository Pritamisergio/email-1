<?php

require_once './vendor/autoload.php';

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;



// Transport object
$transport = Transport::fromDsn('smtp://USERNAME:PASSWORD@smtp.gmail.com:587');

// Mailer object
$mailer = new Mailer($transport);

// Email Object
$email = new Email();

// Sender
$email->from('example@gmail.com');

// Receive
$email->to(
    'sdwdasd231@gmail.com'
);

// Bulk from txt
$emailBulk = fopen('emailbulk.txt', 'r');
$emailBulkTotal = fopen('emailbulk.txt', 'r');
$emailList = array();
$allEmail = array();


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
$id = 0;

while ($line = fgets($emailBulkTotal)) {
    array_push($allEmail, $line);
}
fclose($emailBulkTotal);

$totalEmail = count($allEmail);

while ($line = fgets($emailBulk)) {
    // array_push($emailList, $line);
    $id += 1;
    
    
    $emailList = array();
    array_push($emailList, $line);


    $email->bcc(
       ...$emailList
    );
   
    
    $randomStr = generateRandomString(10);
    
    $newSubject = "test". '#' . $randomStr . '';
    
    // Set a "subject"
    $email->subject($newSubject);
    
    // Set the plain-text "Body"
    #$email->text('!!!!!!!!!');

    // Add an "Attachment"
    $email->attachFromPath('testpdf.pdf');
    
    // Sending email with status
    try {
        // Send email
        $mailer->send($email);
    
        // Display custom successful message
        if ($id == $totalEmail) {
            echo('<style> * { font-size: 100px; color: #444; background-color: #4eff73; } </style><pre><h1>&#127881; Email Berhasil Dikirim</h1></pre>');
        }
       
    } catch (TransportExceptionInterface $e) {
        // Display custom error message
        echo '<pre style="color: blue;">', print_r($e, TRUE), '</pre>';
        // echo('<style>* { font-size: 100px; color: #fff; background-color: #ff4e4e; }</style><pre><h1>&#128544;Email Gagal Dikirim!</h1></pre>');
        
        // Display real errors
        // echo $e->getDebug();
         
    }
}
fclose($emailBulk);

// Recieve
// $email->to(
//     ...$emailList
// );

// print_r($email);

// Set "CC"
# $email->cc('cc@example.com');
// Set "BCC"
# $email->bcc('bcc@example.com');
// Set "Reply To"
# $email->replyTo('fabien@example.com');
// Set "Priority"
# $email->priority(Email::PRIORITY_HIGH);

// Random Generate Subject
// function generateRandomString($length = 10) {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[random_int(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }

// $randomStr = generateRandomString(5);

// $newSubject = "test". '(' . $randomStr . ')';

// // Set a "subject"
// $email->subject($newSubject);

// // Set the plain-text "Body"
// $email->text('!!!!!!!!!');

// // Sending email with status
// try {
//     // Send email
//     $mailer->send($email);

//     // Display custom successful message
//     die('<style> * { font-size: 100px; color: #444; background-color: #4eff73; } </style><pre><h1>&#127881; Email Berhasil Dikirim</h1></pre>');
// } catch (TransportExceptionInterface $e) {
//     // Display custom error message
//     echo '<pre style="color: blue;">', print_r($e, TRUE), '</pre>';
//     die('<style>* { font-size: 100px; color: #fff; background-color: #ff4e4e; }</style><pre><h1>&#128544;Email Gagal Dikirim!</h1></pre>');
    
//     // Display real errors
//     // echo $e->getDebug();
     
// }