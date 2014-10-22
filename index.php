
<?php

	session_start();
	include("db.php");
	include("inc/functions.php");

	//notre requête sql
	$sql="SELECT questions.id AS questId, questions.title, questions.contenu, questions.id_user AS userId,
	questions.keyword1, questions.keyword2, questions.keyword3, questions.keyword4, questions.keyword5,
	users.id AS idUser, users.name, users.avatar, users.email, users.username, users.password, users.job, users.country, users.language, users.externallink
		  FROM questions
		  LEFT JOIN users on users.id=questions.id_user
		  ORDER BY dateCreated DESC
		  LIMIT 3";

	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$questions=$stmt->fetchAll();


	$sql="SELECT vote_type
		  FROM votes
		  LEFT JOIN users on users.id=votes.id_user";

	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$votes=$stmt->fetchAll();


?>
<?php include("inc/top.php"); ?>

		<main class="mainContent">

			<div class="topcontent">
				<a href="questions.php">QUESTIONS</a>

				<?php if (userIslogged()){ ?>
				|<i class="icon-code"></i> <a href="askquestions.php">ASK QUESTION</a>
				<?php } ?>

			</div>
			<div class="maindetail">
				<?php
					foreach($questions as $question):

					?>
			 	<div class="vote">

			 	</div>

			 	<div class="questions">

				 	<a href="questionsDetail.php?id=<?php echo $question['questId']; ?>"> <?php echo $question['title']; ?>
				 	</a>
		           <div id="tag">
            <p class="keyword">
              <a href="questionsByKeyword.php?keyword=<?php echo $question['keyword1']; ?>" id="key1" title="Mot-clef 1"><?php echo $question['keyword1']; ?></a>
            </p>

                <?php if(!empty($question['keyword2'])){ ?>
              <p class="keyword">
              <a href="questionsByKeyword.php?keyword=<?php echo $question['keyword2']; ?>" id="key2" title="Mot-clef 2"><?php echo $question['keyword2']; ?>
                </a>
              </p>
              <?php }?>

                <?php if(!empty($question['keyword3'])){ ?>
              <p class="keyword">
                <a href="questionsByKeyword.php?keyword=<?php echo $question['keyword3']; ?>" id="key3" title="Mot-clef 3"><?php echo $question['keyword3']; ?>
                </a>
              </p>
                <?php }?>

                <?php if(!empty($question['keyword4'])){ ?>
              <p class="keyword">
                <a href="questionsByKeyword.php?keyword=<?php echo $question['keyword4']; ?>" id="key4" title="Mot-clef 4"><?php echo $question['keyword4']; ?>
                </a>
              </p>
                <?php }?>

                <?php if(!empty($question['keyword5'])){ ?>
              <p class="keyword">
                <a href="questionsByKeyword.php?keyword=<?php echo $question['keyword1']; ?>" id="key5" title="Mot-clef 5"><?php echo $question['keyword5']; ?>
                </a>
              </p>
                <?php }?>


				 		<div id="identification">
              <a>asked by</a>
              <?php
              if (empty($question['name'])){
                echo "profil supprimé";
              }else {
                echo "<a href='profile.php?id=".$question['idUser']."'>".$question['name']."</a>";
              }?>
              </a>

            </div>
			 		</div>

			 	</div>
 				<?php endforeach; ?>
			</div>
		</main>



<?php include("inc/bottom.php"); ?>

