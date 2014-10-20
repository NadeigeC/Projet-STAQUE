<?php

session_start();

$id=$_SESSION['user']['id'];


include("db.php");
include("inc/functions.php");
include("inc/top.php");



$sql="SELECT *
	  FROM users
	  WHERE id= :id";


$stmt=$dbh->prepare($sql);

	//exécute la requête 4 execute

	$stmt ->bindValue(":id", $id);
	$stmt->execute();

	//récupère les résultats
	$users=$stmt->fetch();

?>

 <main class="mainContent">

 		<h1> Mon Profil </h1>


			<label for="nom"> NOM:

			<?php if($users['name']==""){
				echo $users['name']="NON RENSEIGNE";
			}
			else echo $users['name'];

			?>

			</label></br>


 			<label for="pseudo"> PSEUDO:

 			<?php if($users['username']==""){
				echo $users['username']="NON RENSEIGNE";
			}
			else echo $users['username'];

			?>

 			 </label></br>

 			<label for="email"> EMAIL:


 			<?php if($users['email']==""){
				echo $users['email']="NON RENSEIGNE";
			}
			else echo $users['email'];

			?>

			<label for="date">


 			 </label></br>











 </main>


 <?php include("inc/bottom.php");
