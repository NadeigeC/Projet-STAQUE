<?php

	session_start();

	include("db.php");
	include("functions.php");

	//déclaration des variables du formulaire
	$email 		= "";

	$errors = array();

	//formulaire soumis ?
	if (!empty($_POST)){

		$email= $_POST['email'];

		//vérifier que l'email existe bel et bien
		$sql = "SELECT email, username, token FROM users
				WHERE email = :email";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->execute();
		$user = $stmt->fetch();

		if (!empty($user)){
			//envoyer un message

			include("phpMailer/PHPMailerAutoload.php"); //chargera les fichiers nécessaires

			$mail = new PHPMailer();        //Crée un nouveau message (Objet PHPMailer)
			$mail->CharSet = 'UTF-8';       //Encodage en utf8

			//INFOS DE CONNEXION
			$mail->isSMTP();                                    //On utilise SMTP
			$mail->Username = "machinchoseformation@gmail.com"; //nom d'utilisateur
			$mail->Password = "38Utc_Sd5KdI4sz0Gr2Y4g";         //mot de passe
			$mail->Host = 'smtp.mandrillapp.com';               //smtp.gmail.com pour gmail
			$mail->Port = 587;                                  //Le numéro de port
			$mail->SMTPAuth = true;                             //On utilise l'authentification SMTP ?
			//$mail->SMTPSecure = 'tls';                        //décommenter pour gmail

			//CONFIGURATION DES PERSONNES
			$mail->setFrom('account@wf3movies.com', 'WF3 Movies !');                   //qui envoie ce message ? (email, noms)
			$mail->addReplyTo('account@wf3movies.com', 'WF3 Movies !');        //à qui répondre si on clique sur "reply" (email, noms)
			$mail->addAddress($user['email'], $user['username']);   //destinataire
			
			//CONFIGURATION DU MESSAGE
			$mail->isHTML(true);                                // Contenu du message au format HTML
			$mail->Subject = 'Password reset on WF3 Movies !';         


			$resetUrl = "http://localhost/movies/password_reset_2.php?email="
			 . urlencode($email) . '&token=' . urlencode($user['token']);

			                       //le sujet
			$mail->Body = 'Yo. Please click on the link below to reset your password:<br /><a href="'.$resetUrl.'">'.$resetUrl.'</a>';                                   //le message

			//envoie le message
			if (!$mail->send()) {
			    echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			    echo "Message sent!";
			}
		}


	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Films</title>
	<meta name="description" content="PHP: Hypertext Preprocessor">
	<link href="css/style.css" type="text/css" rel="stylesheet" />

</head>

	<body>
		<div id="mainregister">
			<div id="contentregister">
				<form method="POST" action="password_reset_1.php" method="POST" novalidate>
					<input type="hidden" name="forn_name" value="password_reset_1" />
					<h3>Mot de passe oublié?</h3>
					<label for="email">email: 
						<input type="text" name="email" value="<?php echo $email;?>"/>
					</label><br/>
					
					<?php 
						if (!empty($errors)){
							echo '<ul class="errors">';
							foreach($errors as $error){
								echo '<li>'.$error.'</li>';
							}
							echo '</ul>';
						}
					?>
					<input type="submit" value="Envoyer">
				</form>
			</div>
			<div class="cnx">
				<a  id="forgotten2"href="login.php" title="Login">Login</a>
				<a id="btn3" href="index.php">Retour accueil</a>

		</div>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/app.js"></script>

	<body>
</html>