<?php

session_start();

$id=$_GET['id'];



include("db.php");
include("inc/functions.php");
include("inc/top.php");


// Requete pour afficher le nombre  de question posées par l'user
$sql="SELECT COUNT(*)
	  FROM questions
	  WHERE id_user= :iduser";

$stmt=$dbh->prepare($sql);
$stmt->bindValue(":iduser",$id);
$stmt->execute();
$questionNumber=$stmt->fetchColumn();


// requete pour affiche rle nombre de réponses données par l'user
 
$sql="SELECT COUNT(*)
	  FROM answers
	  WHERE id_user= :iduser";

$stmt=$dbh->prepare($sql);
$stmt->bindValue(":iduser",$id);
$stmt->execute();
$answerNumber=$stmt->fetchColumn();


// Requete pour afficher la derniere question posée
 
$sql="SELECT title
      FROM questions 
      WHERE id_user=:iduser
      ORDER BY dateCreated DESC
      LIMIT 1 ";

 $stmt=$dbh->prepare($sql);
 $stmt->bindValue(":iduser",$id);
 $stmt ->execute();
 $lastQuestion=$stmt->fetchColumn();

 // Requete pour afficher la derniere réponse postée


 $sql="SELECT contenu
      FROM answers
      WHERE id_user=:iduser
      ORDER BY dateCreated DESC
      LIMIT 1 ";

 $stmt=$dbh->prepare($sql);
 $stmt->bindValue(":iduser",$id);
 $stmt ->execute();
 $lastAnswer=$stmt->fetchColumn();
 



// Requete pour faire apparaitre l'ensemble des colonne de la table users


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

	<div class="">

	
 			<h1> Mon Profil </h1>

 		

<?php 

if (userIsLogged() && $_SESSION['user']['id']==$_GET['id']) { ?>

 		<a href="edit.php">Editer mon profil</a>
 		</div>
 		
<?php } ?>

		<div class="info">

				<h1> Profil de <?php echo $users['username']; ?></h1>

			<p> NOM:

			<?php if($users['name']==""){
				echo $users['name']=" NON RENSEIGNE";
			}
			else echo $users['name'];

			?>

			</p></br>


 			<p> PSEUDO:

 			<?php if($users['username']==""){
				echo $users['username']=" NON RENSEIGNE";
			}
			else echo $users['username'];

			?>

 			 </p></br>

 			<p> EMAIL:


 			<?php if($users['email']==""){
				echo $users['email']=" NON RENSEIGNE";
			}
			else echo $users['email'];

			?>

			</p></br>

			<p>DATE D'INSCRIPTION:

			<?php echo date("d-m-Y à H:i",strtotime($users['dateRegistered']));?>
			</p></br>

			<p> DERNIERE MISE A JOUR:

              <?php echo date("d-m-Y à H:i",strtotime($users['dateModified']));?>

			</p></br>


			<p> METIER:

              <?php if($users['job']==""){
				echo $users['job']=" NON RENSEIGNE";
			}
			else echo $users['job'];

			?>

			</p></br>


			<p> PAYS:

              <?php if($users['country']==""){
				echo $users['country']=" NON RENSEIGNE";
			}
			else echo $users['country'];

			?>

			</p></br>

			<p> LANGUE:

              <?php if($users['language']==""){
				echo $users['language']="NON RENSEIGNEE ";
			}
			else echo $users['language'];

			?>

			</p></br>

			<p> SITE WEB:

              <?php if($users['externallink']==""){
				echo "http://".$users['externallink']="";
			}
			else echo $users['externallink'];

			?></p><br/>

			<div id="activity">

				<h1> STATISTIQUES UTILISATEUR</h1>

			<p> NOMBRE DE QUESTIONS POSEES:
			<?php if(empty($questionNumber)){
				echo "Pas de question posée";
			}
			else echo $questionNumber; ?>

			</p> <br/>

			<p> NOMBRE DE REPONSES:
			<?php if(empty($answerNumber)){

				echo "0";
			}
			else echo $answerNumber ; ?>
			</label> <br/>


			<p> SCORE: 
			<?php echo 5+($questionNumber*2)+($answerNumber*4);
		
			 ?>
			</p> <br/>


			<p> DERNIERE QUESTION POSEE:

			<?php if(empty($lastQuestion)){

				echo "PAS DE CONTRIBUTION";}

				else{
			echo $lastQuestion; } ?>
			</p> <br/>

			<p> DERNIERE REPONSE APPORTEE:

			<?php if(empty($lastAnswer)){
				echo "PAS DE CONTRIBUTION";
			}
			else{
				echo $lastAnswer;
			} ?>

			</p>





			</div>

			<div id="profile-image">

				<?php if(empty ($users['avatar'])){ ?>
					<img src="uploads/avatar/1.jpg"/><?php
				}
				else{
				 ?>
					<img src="uploads/avatar/<?php echo $users['avatar'];?>" height="250" width="200"/>
		<?php } ?>

 			 </div></br>

				

					</div>


 </main>


 <?php include("inc/bottom.php");
