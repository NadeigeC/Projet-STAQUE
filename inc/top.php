<?php

$search = "";
if (!empty($_GET['recherche'])){
    $search = $_GET['recherche'];
}


$sql = "SELECT * FROM questions
                WHERE contenu LIKE :recherche
                OR title LIKE :recherche";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":recherche", "%" . $search . "%");
        $stmt->execute();
        $results = $stmt -> fetchAll();

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

	<link href="css/style2.css" type="text/css" rel="stylesheet" />


</head>
<body>
	<div id="wrapper">

		<nav id="head">

			<div id="connexion">


				<?php

					if (userIsLogged()){ ?>
					<div id="connect"> <?php echo "Bonjour ".'<span class="espace"></span>'.'<i class="icon-home"></i>'.'<span class="espace"></span>' .'<a href="profile.php?id='.$_SESSION['user']['id'].'">'.$_SESSION['user']['username'] . " !".'</a>'; ?>
					<!-- <a href="profile.php"></a>  -->
					<i class="icon-signout"></i><a href="logout.php">DECONNEXION</a>

			</div>

				<?php 	}
				else {
				?>
					<a class="login" href="login.php">CONNEXION</a>
					<a class="signup" href="register.php">INSCRIPTION</a>
				<?php } ?>
			</div>
			<a href="index.php">
				<img src="img/stackthree.png" height="100" width="100" id="logostack"/>
			</a>

			<h1><a href="index.php"> <span style="color">STA</span>QUE </a></h1>



		</nav>



		<div class="secondcontent">



					<a href="questions.php"><i class="icon-comment"></i>QUESTIONS</a>

					<?php if (userIslogged()){ ?>

					<a href="askquestions.php"><i class="icon-code"></i>ASK QUESTION</a>
					<?php } ?>


					<a href="questions.php"><i class="icon-tags"></i>TAGS</a>



				<form id="searchbar" method="GET" action="index.php">
					<input type="text" placeholder="Rechercher" name="recherche">
					<input type="submit" value="">
				</form>
		</div>

