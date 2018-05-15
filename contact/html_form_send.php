<?php
if(isset($_POST['email'])) {
	
	// CHANGE THE TWO LINES BELOW
	$email_to = "jornax137@gmail.com";
	
	$email_subject = "Contact: E-portfolio Jaron Trossaert";
	
	
	function died($error) {
		// your error code can go here
		echo "Sorry, er werden fouten gevonden in de boodschap die verstuurd moest worden.<br /><br />";
		echo $error."<br /><br />";
		echo "Gelieve de te versturen boodschap op fouten na te kijken.<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['first_name']) ||
		!isset($_POST['last_name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['telephone']) ||
		!isset($_POST['comments'])) {
		died('Sorry, er lijkt een fout gevonden te zijn in de boodschap die verstuurd moest worden.');		
	}
	
	$first_name = $_POST['first_name']; // required
	$last_name = $_POST['last_name']; // required
	$email_from = $_POST['email']; // required
	$telephone = $_POST['telephone']; // not required
	$comments = $_POST['comments']; // required
	
	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
  	$error_message .= 'Foutief e-mailadres.<br />';
  }
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
  	$error_message .= 'Foutieve voornaam.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
  	$error_message .= 'Foutieve achternaam.<br />';
  }
  if(strlen($comments) < 2) {
  	$error_message .= 'Er lijkt een fout te zitten in het bericht.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Formulierdata hieronder.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Voornaam: ".clean_string($first_name)."\n";
	$email_message .= "Achternaam: ".clean_string($last_name)."\n";
	$email_message .= "E-mail: ".clean_string($email_from)."\n";
	$email_message .= "Telefoon: ".clean_string($telephone)."\n";
	$email_message .= "Bericht: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>

<!-- place your own success html below -->

Bedankt om contact op te nemen met mij. Ik stuur spoedig een antwoord.

<?php
}
die();
?>