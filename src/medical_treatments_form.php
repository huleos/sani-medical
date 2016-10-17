<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$myemail = '';
$bccmail = 'creativo@686studio.com';
$noreply = 'noreply@sanimedicaltourism.com';

$name = $_POST['yourName'];
$phone = $_POST['yourNumber'];
$email = $_POST['yourEmail'];
$city = $_POST['yourCity'];
$treatment = $_POST['yourTreatment'];
$message = $_POST['yourMessage'];
$origin = $_POST['elOrigin'];
$utm = $_POST['utm_medical_treatments'];
$fieldHidden = isset($_POST['elAddress']) ? $_POST['elAddress'] : null;

if($name && $phone && $email && $city && $treatment && $message)
{
	$to = $noreply; 
	$email_subject = "$origin";
	$email_body = "You have received a new message of Sani Medical".
	" Here are the details:\n
	Name: $name \n
	Phone: $phone \n
	Email: $email \n
	City: $city \n
	Treatment: $treatment \n
	Message: \n $message \n
	UTM: $utm";
	
	$headers = "From: $name <$email>\n";
	$headers .= "Reply-To: $noreply\n";
	$headers .= "Bcc: " . $bccmail;
	if(!$fieldHidden)
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: /thanks.html');
} 
?>