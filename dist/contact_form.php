<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$myemail = 'creativo@686studio.com';//<-----Put Your email address here.
$bccmail = '';//<-----Put Your BCC email address here.
$noreply = 'noreply@sanimedicaltourism.com';

$name = $_POST['yourName'];
$location = $_POST['yourLocation'];
$phone = $_POST['yourNumber'];
$message = $_POST['yourMessage'];
$origin = $_POST['elOrigin'];
$utm = $_POST['utm_contact'];
$fieldHidden = isset($_POST['elAddress']) ? $_POST['elAddress'] : null;

if($name && $location && $phone && $message)
{
	$to = $myemail; 
	$email_subject = "$origin";
	$email_body = "You have received a new message of Giostar Mexico".
	" Here are the details:\n
	Name: $name \n
	Location: $location \n
	Phone: $phone \n
	Message: \n $message \n
	UTM: $utm";
	
	$headers = "From: $noreply\n"; /*Campo del Email del cliente*/
	$headers .= "Reply-To: $noreply\n"; /*Campo del Email de respuesta*/
	$headers .= "Bcc: " . $bccmail; /*Campo del Email de copia oculta*/
	if(!$fieldHidden)
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: /thanks.html');
}
?>