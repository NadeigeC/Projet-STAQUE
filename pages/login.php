<?php
	session_start();
	include("../inc/top.php");
	include("db.php");
	include("../functions.php");

	//déclaration des variables du formulaire
	$username 		= "";
	$password 		= "";

	$errors = array();

	//formulaire soumis ?
	if (!empty($_POST)){

		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)
		$username 		= strip_tags($_POST['username']);
		$password 		= $_POST['password'];

		//validation

		//username
		if (empty($username)){
			$errors[] = "Please provide an username !";
		}

		//password
		if (empty($password)){
			$errors[] = "Please choose a password !";
		}

		//form valide ?
		if (empty($errors)){
			
			//recherche l'utilisateur en bdd par son username (ou email)
			$sql = "SELECT * FROM users
					WHERE username = :login OR email = :login
					LIMIT 1";

			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(":login", $username);
			$stmt->execute();

			$user = $stmt->fetch();

			$hashedPassword = hashPassword($password, $user['salt']);
			if ($hashedPassword === $user['password']){
				$_SESSION['user'] = $user;
				header("Location: index.php");
				die();
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
			<div id="contentregister" id="form_sign">
				<form method="POST" action="login.php" id="form_sign" method="POST" novalidate>
					<label for="username">Username: 
						<input type="text" name="username" value="<?php echo $username;?>"/>
					</label><br/>
					<label for="password">Password: 
						<input type="password" name="password" value="<?php echo $password; ?>">
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
					<input type="submit" value="Sign in!">
				</form>
			</div>
			<div class="cnx">
				<a  id="forgotten"href="password_reset_1.php" title="Forgot your password ?">Forgot your password ?</a>
				<a id="btn3" href="index.php">Retour accueil</a>
		</div>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/app.js"></script>

	<body>
</html>