
<?php

	session_start();
	include("db.php");
	include("inc/functions.php");

	//notre requête sql 
	$sql="SELECT * 
		  FROM questions
		  LEFT JOIN users on users.id=questions.id_user
		  ";
 	
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
		  LEFT JOIN users on users.id=votes.id_user

		
		  ";
 	
	//envoie la requête au serveur MySQL (statement) 3 prepare
	$stmt=$dbh->prepare($sql);

	//exécute la requête 4 execute
	$stmt->execute();

	//récupère les résultats
	$votes=$stmt->fetchAll();
	//print_r($results);

	

	


?>
<?php include("inc/top.php"); ?>

	
		<main class="mainContent">
			<div class="topcontent">
				<a href="questions.php"><button>Questions</button></a>
				<a href="askquestions.php"><button>Ask Question</button></a>
				<!--<a href="logout.php"><button>Déconnexion</button></a>-->
				
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
				 		<p><?php echo $question['keyword1']; ?></p>
				 		<p><?php echo $question['keyword2']; ?></p>
				 		<p><?php echo $question['keyword3']; ?></p>
				 		<div id="identification">
					 		<a>asked by</a>
					 		<a href=""><?php echo $question['username']; ?></a>
					 		
				 		</div>
						
			 		</div>
			 		
			 	</div>
 				<?php endforeach; ?>
			</div>
		</main>
		<footer>
			<div id="foot">
				<div class="topfoot">
					<a href="">help |</a>
					<a href="">chat |</a>
					<a href="">data |</a>
					<a href="">legal |</a>
					<a href="">privacy policy |</a>
					<a href="">work here |</a>
					<a href="">advertising info |</a>
					<a href="">contact us |</a>
					<a href="">feedback </a>
				</div>
				<div class="contentfoot">
				<h3>TECHNOLOGY</h3>
				<div class="leftfoot">
					<a href="">Stack Overflow</a>
					<a href="">Server Fault</a>
					<a href="">Super user</a>
					<a href="">Web Applications</a>
					<a href="">Ask Ubuntu</a>
				</div>
				<div class="rightfoot">
					<a href=""> Webmasters</a><br/>
					<a href="">Game Development</a><br/>
					<a href="">programmers</a><br/>
					<a href="">WordPress Development</a><br/>
					<a href="">Information security</a>
				</div>
				</div>
				<div id="copy">
					<p>Site design/ logo &copy; <?php echo date("Y"); ?> staque corporation; user  contributions licensed under <a href=""> ccby-sa 3.0</a>
				</div>	
			</div>	
			
		</footer>


</body>
</html>

