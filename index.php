
<?php

	session_start();
	include("db.php");
	include("inc/functions.php");

	$question['keyword2'] = "";
	$question['keyword3'] = "";
	$question['keyword4'] = "";
	$question['keyword5'] = "";

	//notre requête sql
	$sql="SELECT *
		  FROM questions
		  LEFT JOIN users on users.id=questions.id_user
		  ORDER BY dateCreated DESC
		  LIMIT 3";

	//envoie la requête au serveur MySQL (statement) 3 prepare
	$stmt=$dbh->prepare($sql);

	//exécute la requête 4 execute
	$stmt->execute();

	//récupère les résultats
	$questions=$stmt->fetchAll();
	//print_r($results);


	//notre requête sql
	$sql="SELECT vote_type
		  FROM votes
		  LEFT JOIN users on users.id=votes.id_user";

	//envoie la requête au serveur MySQL (statement) 3 prepare
	$stmt=$dbh->prepare($sql);

	//exécute la requête 4 execute
	$stmt->execute();

	//récupère les résultats
	$votes=$stmt->fetchAll();
	//print_r($results);
?>
<?php include("inc/top.php"); ?>

	<!-- <div id="join">
    <h3> Pourquoi s'incrire sur Staque.fr?</h3>

     <p> Devenir membre sur Staque, c'est la possibilité de pouvoir échanger avec la communauté. De poser de nouvelles questions, de répondre aux différents sujets et de commenter les réponses déja données. </p>

     <p> La création d'un compte sur Staque est totalement gratuite! Rejoignez dès maintenant  la première plateforme francophone dédiée au développement web!</p>
	</div> -->

		<main class="mainContent">

			<div class="topcontent">
				<a href="questions.php">QUESTIONS</a>

				<?php if (userIslogged()){ ?>
				| <a href="askquestions.php">ASK QUESTION</a>
				<?php } ?>



			</div>
			<div class="maindetail">
				<?php
					foreach($questions as $question):

					?>
			 	<div class="vote">

			 	</div>

			 	<div class="questions">

				 	<a href=""> <?php echo $question['title']; ?>
				 	</a>
			 		<div id="tag">
			 			<p class="keyword">
			 				<?php echo $question['keyword1']; ?>
			 			</p>

								<?php if(!empty($question['keyword2'])){ ?>
				 			<p class="keyword"> <?php echo $question['keyword2']; ?></p>
				 			<?php }?>

								<?php if(!empty($question['keyword3'])){ ?>
				 			<p class="keyword"><?php echo $question['keyword3']; ?></p>
								<?php }?>

								<?php if(!empty($question['keyword4'])){ ?>
				 			<p class="keyword"><?php echo $question['keyword4']; ?></p>
								<?php }?>

								<?php if(!empty($question['keyword5'])){ ?>
				 			<p class="keyword"><?php echo $question['keyword5']; ?></p>
								<?php }?>


				 		<div id="identification">
					 		<a>asked by</a>
					 		<a href=""><?php echo $question['username']; ?></a>

				 		</div>

			 		</div>

			 	</div>
 				<?php endforeach; ?>
			</div>
		</main>



<?php include("inc/bottom.php"); ?>

