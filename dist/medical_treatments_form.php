<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$myemail = '$email';//<-----Put Your email address here.
$bccmail = 'creativo@686studio.com';//<-----Put Your BCC email address here.
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
	$to = $email; 
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
	
	$headers = "From: Sani Medical Tourism\n"; /*Campo del Email del cliente*/
	$headers .= "Reply-To: $noreply\n"; /*Campo del Email de respuesta*/
	$headers .= "Bcc: " . $bccmail; /*Campo del Email de copia oculta*/
	if(!$fieldHidden)
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: /thanks.html');
} 
?>