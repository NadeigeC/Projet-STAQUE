
<?php



?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Base</title>
	<meta name="description" content="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'>
	<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div id="wrapper">

		<nav id="head">
			<div id="connexion">

				<?php
					if (userIsLogged()){
					echo "Bonjour " .'<a href="profile.php">'.$_SESSION['user']['username'] . " !".'</a>'; ?>
					<a href="profile.php"></a> |
					<a href="logout.php">DECONNEXION</a>
				<?php 	}
				else {
				?>
					<a class="login" href="login.php">CONNEXION</a> |
					<a class="signup"href="register.php">NOUVEAU COMPTE</a>
				<?php } ?>
			</div>

			<h1><a href="index.php"> <span>&lt;?= </span>STAQUE <span> <?php echo "; ?>";?> </span> </a></h1>
			<input type="text" name="search" value="Search" placeholder="Recherche" id="search">

		</nav>



<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
 -->
<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"> -->