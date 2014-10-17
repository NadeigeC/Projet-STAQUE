
<!DOCTYPE html>
<html lang="fr" class="<?php echo $page; ?>">
<head>
	<meta charset="utf-8">
	<title>Base</title>
	<meta name="description" content="">
	<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div id="wrapper">

		<nav id="head">
		
		<?php	
			if (userIsLogged()){
			echo "Yo " . $_SESSION['user']['username'] . "!"; ?>
			<a href="logout.php"><button>Déconnexion</button></a>
		<?php 	}
		else {
		?>
			<a class="login" href="login.php"><button>Log In</button></a>
			<a class="signup"href="register.php"><button>Sign up</button></a>
		<?php } ?>
			
			<h1>Stackoverflone</h1>
			<input type="text" name="search" value="Search">
			
		</nav>