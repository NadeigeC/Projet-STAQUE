
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
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

	<link href="css/style.css" type="text/css" rel="stylesheet" />


</head>
<body>
	<div id="wrapper">

		<nav id="head">


			<div id="connexion">


				<?php
					if (userIsLogged()){
					echo "Bonjour " .'<a href="profile.php?id='.$_SESSION['user']['id'].'">'.$_SESSION['user']['username'] . " !".'</a>'; ?>
					<a href="profile.php"></a> |
					<i class="icon-signout"></i><a href="logout.php">DECONNEXION</a>
				<?php 	}
				else {
				?>
					<a class="login" href="login.php">CONNEXION</a> |
					<a class="signup"href="register.php">NOUVEAU COMPTE</a>
				<?php } ?>
			</div>

			<h1><a href="index.php"> <span style="color">STA</span>QUE </a></h1>
					

		</nav>
			
		<div class="secondcontent">

			<div class="topcontent">
			<i class="icon-comment"></i>
				<a href="questions.php">QUESTIONS</a>

				<?php if (userIslogged()){ ?>
				|<i class="icon-code"></i> <a href="askquestions.php">ASK QUESTION</a>
				<?php } ?>

			</div>

			<form id="searchbar">
				<input type="text" placeholder="Rechercher">
				<input type="submit" value="">
			</form>
		</div>




<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
 -->
<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"> -->