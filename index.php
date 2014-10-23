
<?php

	session_start();
	include("db.php");
	include("inc/functions.php");

$search = "";
if (!empty($_GET['recherche'])){
    $search = $_GET['recherche'];

    $sql = "SELECT COUNT(answers.id) AS answCount, questions.id AS questId, questions.title, questions.contenu, questions.id_user AS userId, questions.dateCreated, questions.vues,
  questions.keyword1, questions.keyword2, questions.keyword3, questions.keyword4, questions.keyword5,
  users.id AS idUser, users.name, users.avatar, users.email, users.username, users.password, users.job, users.country, users.language, users.externallink
      FROM questions
      LEFT JOIN users on users.id=questions.id_user
      LEFT JOIN answers on questions.id=answers.id_question
        WHERE questions.contenu LIKE :recherche
            OR questions.title LIKE :recherche
        GROUP BY answers.id_question
        ORDER BY questions.dateCreated DESC";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":recherche", "%" . $search . "%");
        $stmt->execute();
        $questions = $stmt -> fetchAll();
}

else {

	//notre requête sql
	$sql="SELECT COUNT(answers.id) AS answCount, questions.id AS questId, questions.title, questions.contenu, questions.id_user AS userId, questions.dateCreated, questions.vues,
  questions.keyword1, questions.keyword2, questions.keyword3, questions.keyword4, questions.keyword5,
  users.id AS idUser, users.name, users.avatar, users.email, users.username, users.password, users.job, users.country, users.language, users.externallink
      FROM questions
      LEFT JOIN users on users.id=questions.id_user
      LEFT JOIN answers on questions.id=answers.id_question
          GROUP BY answers.id_question
          ORDER BY questions.dateCreated DESC
		  LIMIT 3";

	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$questions=$stmt->fetchAll();
}

	// $sql="SELECT vote_type
	// 	  FROM votes
	// 	  LEFT JOIN users on users.id=votes.id_user";

	// $stmt=$dbh->prepare($sql);
	// $stmt->execute();
	// $votes=$stmt->fetchAll();
?>
<?php include("inc/top.php"); ?>



			<div class="topcontent">

			</div>

			<main class="main_index_questions">

            <div>
			<main class="mainContentQuestions">


        <h1> Dernières questions postées...</h1>

				<?php
					foreach($questions as $question):

					?>
			 	 <div class="vote">
        <?php echo "VOTES";?>
        </div>
        <div class="answer">
        <?php echo $question['answCount'];?>
        <p>REPONSES</p>
        </div>
        <div class="vue">
        <?php echo $question['vues'];?>
        <p>VUES</p>
        </div>

			 	<div class="questions">

				 	<a href="questionsDetail.php?id=<?php echo $question['questId']; ?>" id="titreQuest"> <?php echo $question['title']; ?>
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
              <a>postée par</a>
              <?php
              if (empty($question['name'])){
                echo "profil supprimé";
              }else {
                echo "<a href='profile.php?id=".$question['idUser']."'>".$question['name']."</a>";
              }?>
              </a>le <?php
              $unix = strtotime($question['dateCreated']);
                        echo date("d-m-Y", $unix); ?>

            </div>
			 		</div>

			 	</div>
 				<?php endforeach; ?>
			</div>
		</main>
</div>


<?php include("inc/bottom.php"); ?>

