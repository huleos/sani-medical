<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$myemail = '';
$bccmail = 'creativo@686studio.com';
$noreply = 'noreply@sanimedicaltourism.com';

$name = $_POST['yourName'];
$email = $_POST['yourEmail'];
$phone = $_POST['yourNumber'];
$date = $_POST['yourDate'];
$message = $_POST['yourMessage'];
$origin = $_POST['elOrigin'];
$fieldHidden = isset($_POST['honeypot']) ? $_POST['honeypot'] : null;

if($name && $email && $phone && $date && $message)
{
	$to = $noreply; 
	$email_subject = "$origin";
	$email_body = "You have received a new message of Sani Medical".
	" Here are the details:\n
	Name: $name \n
	Email: $email \n
	Phone: $phone \n
	Desired date: $date \n
	Message: \n $message";
	
	$headers = "From: $name <$email>\n";
	$headers .= "Reply-To: $noreply\n";
	$headers .= "Bcc: " . $bccmail;
	if(!$fieldHidden)
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: /thanks.html');
}
?>