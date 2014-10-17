<?php

	session_start();

	include("db.php");
	include("functions.php");

	$email = "";
	if (!empty($_GET['email'])){
		$email = $_GET['email'];
	}		
	$token = "";
	if (!empty($_GET['token'])){
		$token = $_GET['token'];
	}

	if ($token && $email){
		//vérifier que les données dans l'url sont valides
		$sql = "SELECT * FROM users
				WHERE email = :email AND token = :token";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":token", $token);
		$stmt->execute();
		$foundUser = $stmt->fetch();
	}

	if (empty($foundUser)){
		die("oops");
	}

	//déclaration des variables du formulaire
	$password 		= "";
	$password_bis  	= "";

	$errors = array();

	//formulaire soumis ?
	if (!empty($_POST)){

		$password 		= $_POST["password"];
		$email 		= $_POST["email"];
		$token 		= $_POST["token"];
		$password_bis  	= $_POST['password_bis '];


		//password
		if (empty($password)){
			$errors[] = "Please choose a password !";
		}
		elseif (empty($password_bis)){
			$errors[] = "Please confirm your password !";
		}
		elseif ($password_bis != $password){
			$errors[] = "Your passwords do not match !";
		}
		elseif (strlen($password) < 7){
			$errors[] = "Your password should have at least 7 characters !";
		}

		if (empty($errors)){
			
			$sql = "UPDATE users 
					SET password = :password,
						dateModified = NOW()
					WHERE email = :email 
					AND token = :token";

			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(":password", hashPassword($password, $foundUser['salt']));
			$stmt->bindValue(":email", $email);
			$stmt->bindValue(":token", $token);
			if ($stmt->execute()){
				$sql = "UPDATE users 
						SET token = :token,
							dateModified = NOW()
						WHERE email = :email";

				$stmt = $dbh->prepare($sql);
				$stmt->bindValue(":token", randomString());
				$stmt->bindValue(":email", $email);
				if ($stmt->execute()){
					//log the user automatically
					$_SESSION['user'] = $foundUser;
					header("Location: index.php");
					die();
				}
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
				<form method="POST" action="password_reset_2.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST" novalidate>
					<input type="hidden" name="forn_name" value="password_reset_1" />
					<!-- peut servir pour détecter facilement QUEL formulaire a été soumis -->
					<input type="hidden" name="forn_name" value="password_reset_2" />
					<input type="hidden" name="token" value="<?= $token ?>" />
					<input type="hidden" name="email" value="<?= $email ?>" />
					<h3>Nouveau mot de passe<h3>
					<label for="passwod">New password: 
						<input type="password" name="password" value=""/>
					</label><br/>
					<label for="password_bis">confirmer: 
						<input type="text" name="$password_bis " value=""/>
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
					<input type="submit" value="Save">
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