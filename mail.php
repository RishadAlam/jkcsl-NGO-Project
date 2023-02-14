<?php
$to_email = "chennelone001@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi ChannelONE, Your Login Password is 63572918";
$fromEmail = "contact@jonokollan.com";
$headers = "From: " . $fromEmail;
var_dump(mail($to_email, $subject, $body, $headers));
// var_dump($headers);
die();
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}

// echo basename($_SERVER['PHP_SELF']);