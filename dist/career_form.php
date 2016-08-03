<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$myemail = 'creativo@686studio.com';//<-----Put Your email address here.
$bccmail = '';//<-----Put Your BCC email address here.
$noreply = 'noreply@sanimedicaltourism.com';

$name = $_POST['yourName'];
$phone = $_POST['yourNumber'];
$email = $_POST['yourEmail'];
$city = $_POST['yourCity'];
$dateBirth = $_POST['yourDateOfBirth'];
$gender = $_POST['yourGender'];
$position = $_POST['yourPosition'];
$english = $_POST['langEnglish'];
$spanish = $_POST['langSpanish'];
$worked = $_POST['yourWorked'];
$message = $_POST['yourMessage'];
$origin = $_POST['elOrigin'];
$fieldHidden = isset($_POST['elAddress']) ? $_POST['elAddress'] : null;

if($name && $phone && $email && $city && $dateBirth && $gender && $position && $english && $spanish && $worked && $message)
{
	$to = $myemail; 
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
	English: $english% \n
	Spanish: $spanish% \n
	Have you worked in Mexico before?: $worked \n
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