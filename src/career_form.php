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
$dateBirth = $_POST['yourDateOfBirth'];
$gender = $_POST['yourGender'];
$position = $_POST['yourPosition'];
$education = $_POST['yourEducation'];
$english = $_POST['langEnglish'];
$spanish = $_POST['langSpanish'];
$worked = $_POST['yourWorked'];
$message = $_POST['yourMessage'];
$origin = $_POST['elOrigin'];
$utm = $_POST['utm_career'];
$fieldHidden = isset($_POST['elAddress']) ? $_POST['elAddress'] : null;

if($name && $phone && $email && $city && $dateBirth && $gender && $position && $english && $spanish && $worked && $message)
{
	$to = $noreply;
	$email_subject = "$origin";
	$email_body = "You have received a new message of Sani Medical".
	" Here are the details:\n
	Name: $name \n
	Phone: $phone \n
	Email: $email \n
	City: $city \n
	Date of birth: $dateBirth \n
	Gender: $gender \n
	Position: $position \n
	Highest education grade?: $education \n
	English: $english% \n
	Spanish: $spanish% \n
	Have you worked in Mexico before?: $worked \n
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