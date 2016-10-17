<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$myemail = '';
$bccmail = 'creativo@686studio.com';
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
$utm = $_POST['utm_medical_tourism_facilitator'];
$fieldHidden = isset($_POST['elAddress']) ? $_POST['elAddress'] : null;

if($name && $phone && $company && $website && $email && $work && $role && $worked && $message)
{
	$to = $noreply; 
	$email_subject = "$origin";
	$email_body = "You have received a new message of Sani Medical".
	" Here are the details:\n
	Name: $name \n
	Phone: $phone \n
	Company: $company \n
	Website: $website \n
	Email: $email \n
	How many clinics/hospital/doctors do you work with?: $work \n
	Role: $role \n
	Have you worked in Mexico before? $worked \n
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