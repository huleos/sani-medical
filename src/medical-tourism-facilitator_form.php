<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$myemail = 'creativo@686studio.com';//<-----Put Your email address here.
$bccmail = '';//<-----Put Your BCC email address here.
$noreply = 'noreply@sanimedicaltourism.com';

$name = $_POST['yourName'];
$phone = $_POST['yourNumber'];
$company = $_POST['yourCompany'];
$website = $_POST['yourWebsite'];
$email = $_POST['yourEmail'];
$work = $_POST['yourWork'];
$role = $_POST['yourRole'];
$worked = $_POST['yourWorked'];
$message = $_POST['yourMessage'];
$origin = $_POST['elOrigin'];
$fieldHidden = isset($_POST['elAddress']) ? $_POST['elAddress'] : null;

if($name && $phone && $company && $website && $email && $work && $role && $worked && $message)
{
	$to = $myemail; 
	$email_subject = "$origin";
	$email_body = "You have received a new message of Giostar Mexico".
	" Here are the details:\n
	Name: $name \n
	Phone: $phone \n
	Company: $company \n
	Website: $website \n
	Email: $email \n
	How many clinics/hospital/doctors do you work with?: $work \n
	Role: $role \n
	Have you worked in Mexico before? $worked \n
	Message: \n $message"; 
	
	$headers = "From: $noreply\n"; /*Campo del Email del cliente*/
	$headers .= "Reply-To: $noreply\n"; /*Campo del Email de respuesta*/
	$headers .= "Bcc: " . $bccmail; /*Campo del Email de copia oculta*/
	if(!$fieldHidden)
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: /thanks.html');
} 
?>