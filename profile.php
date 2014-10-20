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


		<div class="profilemenu">
 		<h1> Mon Profil </h1>
 		<a href="edit.php">Editer mon profil</a>
 		</div>


		<div class="info">

			<label for="nom"> NOM:

			<?php if($users['name']==""){
				echo $users['name']=" NON RENSEIGNE";
			}
			else echo $users['name'];

			?>

			</label></br>


 			<label for="pseudo"> PSEUDO:

 			<?php if($users['username']==""){
				echo $users['username']=" NON RENSEIGNE";
			}
			else echo $users['username'];

			?>

 			 </label></br>

 			<label for="email"> EMAIL:


 			<?php if($users['email']==""){
				echo $users['email']=" NON RENSEIGNE";
			}
			else echo $users['email'];

			?>

			</label></br>

			<label for="date">DATE D'INSCRIPTION:

			<?php echo date("d-m-Y à H:i",strtotime($users['dateRegistered']));?>
			</label></br>


			<label for="country"> METIER:

              <?php if($users['job']==""){
				echo $users['job']=" NON RENSEIGNE";
			}
			else echo $users['job'];

			?>

			</label></br>


			<label for="Job"> PAYS:

              <?php if($users['country']==""){
				echo $users['country']=" NON RENSEIGNE";
			}
			else echo $users['country'];

			?>

			</label></br>

			<label for="language"> LANGUE:

              <?php if($users['language']==""){
				echo $users['language']="NON RENSEIGNEE ";
			}
			else echo $users['language'];

			?>

			</label></br>

			<label for="external link"> SITE WEB:

              <?php if($users['externallink']==""){
				echo "http://".$users['externallink']="";
			}
			else echo $users['language'];

			?>

			</label></br>


			<div id="profile-image">

				<?php if(empty ($users['avatar'])){ ?>
					<img src="uploads/avatar/1.jpg"/><?php
				}
				else{
				 ?>
					<img src="uploads/avatar/<?php echo $users['avatar'];?>"/>
		<?php } ?>

 			 </div></br>

			</div>










 </main>


 <?php include("inc/bottom.php");
