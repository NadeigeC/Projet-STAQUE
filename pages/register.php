<?php


	session_start();
	include("../inc/top.php");
	include("db.php");
	include("../functions.php");

	//déclaration des variables du formulaire
	$email 			= "";
	$username 		= "";
	$password 		= "";
	$password_bis   ="";

	$errors = array();

	//formulaire soumis ?
	if (!empty($_POST)){
		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)
		
		$email 			= strip_tags($_POST['email']);
		$username 		= strip_tags($_POST['username']);
		$password 		= $_POST['password'];
		$password_bis	= $_POST['password_bis'];

		//validation

		//email
		if (empty($email)){
			$errors[] = "Please provide an email !";
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Your email is not valid !";
		}
		elseif (emailExists($email)){
			$errors[] = "This email already exists !";
		}

		//username
		if (empty($username)){
			$errors[] = "Please provide an username !";
		}
		//vérifie si username est présent en bdd
		elseif (usernameExists($username)){
			$errors[] = "This username already exists !";
		}

		//password
		if (empty($password)){
			$errors[] = "Please choose a password !";
		}
		elseif (empty($password_bis )){
			$errors[] = "Please confirm your password !";
		}
		elseif ($password_bis  != $password){
			$errors[] = "Your passwords do not match !";
		}
		elseif (strlen($password) < 7){
			$errors[] = "Your password should have at least 7 characters !";
		}


		//form valide ?
		if (empty($errors)){
			//prépare les données pour l'insertion en base

			//génère un salt unique pour cet user
			$salt = randomString();

			//fonction déclarée dans functions.php
			$hashedPassword = hashPassword($password, $salt);

			//utilisée pour l'oubli du mdp, le remember me...
			$token = randomString();

			//sql d'insertion de l'user
			$sql = "INSERT INTO users (email, username, password, salt, token, dateRegistered, dateModified) 
				VALUES (:email, :username, :password, :salt, :token, NOW(), NOW())";

			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(":email", $email);
			$stmt->bindValue(":username", $username);
			$stmt->bindValue(":password", $hashedPassword);
			$stmt->bindValue(":salt", $salt);
			$stmt->bindValue(":token", $token);

			$stmt->execute();
							
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
		<div id="mainregister" >
			<div id="contentregister" >
				<form method="POST"  action="register.php" id="form_sign"novalidate>
					<label for="pseudo">Pseudo: 
						<input type="text" name="username" value="<?php echo $username;?>">
					</label><br/>
					<label for="email">Email: 
						<input type="email" name="email" value="<?php echo $email;?>">
					</label><br/>
					<label for="password">Password: 
						<input type="password" name="password" value="<?php echo $password; ?>">
					</label><br/>
					<label for="password_bis">Confirmed password: 
						<input type="password" name="password_bis" value="<?php echo $password_bis; ?>">
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
					<input type="submit" value="Enregister">
					
				</form>
			</div>
			<div class="cnx">
				<a id="btn3" href="index.php">Retour accueil</a>
				<h3>Vous avez déjà un compte ?</h3>
				<a  id="btn4"href="login.php">Se connecter</a>
		</div>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/app.js"></script>

	<body>
</html>