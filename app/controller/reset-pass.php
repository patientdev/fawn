<?php

include('Mail.php');
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/connect.php";

$email = $_POST["email"];
$result = $db->prepare("SELECT password FROM artists WHERE email = :email LIMIT 1");
$result->bindParam(':email', $email);
$result->execute();
$pass = $result->fetch();

// $recipients = $email;
// $headers['From'] = 'info@forgerworldwide.org';
// $headers['To'] = $email;
// $headers['Subject'] = 'Your FAWN login information';
// $body = "Your password is $pass.";
// $params['sendmail_path'] = '/nfsn/sendmail';
// $mail =& Mail::factory('sendmail', $params);
// $result = $mail->send($recipients, $headers, $body);
echo $pass["password"];

$db = null;

?>