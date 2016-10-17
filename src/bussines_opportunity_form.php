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
$role = $_POST['yourRole'];
$message = $_POST['yourMessage'];
$origin = $_POST['elOrigin'];
$utm = $_POST['utm_bussines_opportunity'];
$fieldHidden = isset($_POST['elAddress']) ? $_POST['elAddress'] : null;

if($name && $phone && $company && $website && $email && $role && $message)
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
	Role: $role \n
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