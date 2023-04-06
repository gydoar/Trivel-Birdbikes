<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require("class.phpmailer.php");
$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

// LAST NAME
if (empty($_POST["last"])) {
    $errorMSG = "Last Name is required ";
} else {
    $last = $_POST["last"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}


// prepare email body text
$MsgContent = "";
$MsgContent .= "Name: ";
$MsgContent .= $name;
$MsgContent .= "<br> \n";
$MsgContent .= "Last: ";
$MsgContent .= $last;
$MsgContent .= "<br> \n";
$MsgContent .= "Email: ";
$MsgContent .= $email;
$MsgContent .= "<br> \n";
$MsgContent .= "Message: ";
$MsgContent .= $message;
$MsgContent .= "<br> \n";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; 
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "smtp.mail.com"; 
$mail->Port = 465; 
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = "mail@mail.com"; 
$mail->Password = "password"; 
$mail->SetFrom("mail@mail.com", "Name"); 
$mail->AddAddress("mail@mail.com"); 
$mail->Subject = "Subject"; 
$mail->Body = $MsgContent ; 

$success = $mail->Send();


if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG . "<br> Mailer Error: " . $mail->ErrorInfo;
    }
}
