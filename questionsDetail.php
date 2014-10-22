
<?php
    session_start();
    //connexion
    include("db.php");
    include("inc/functions.php");
    include("inc/top.php");

$id = "";
if (!empty($_GET['id'])){
    $id = $_GET['id'];
  }



$sql="SELECT questions.id AS questId, questions.title, questions.contenu, questions.id_user AS userId,
  questions.keyword1, questions.keyword2, questions.keyword3, questions.keyword4, questions.keyword5, questions.dateCreated,
  users.id AS idUser, users.name, users.avatar, users.email, users.username, users.password, users.job, users.country, users.language, users.externallink
      FROM questions
      LEFT JOIN users on users.id=questions.id_user
      WHERE questions.id= :id";

    $stmt=$dbh->prepare($sql);
    $stmt ->bindValue(":id", $id);
    $stmt->execute();
    $question=$stmt->fetch();

$sql="SELECT answers.id, answers.id_question, answers.contenu, answers.id_user, answers.dateCreated, users.id, users.username
      FROM answers
      LEFT JOIN users on users.id=answers.id_user";

    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $answers=$stmt->fetchAll();


$sql="SELECT comments.id AS commId, comments.id_question, comments.contenu AS commContent, comments.id_user, comments.id_answer AS commAnswId, comments.dateCreated,
answers.id answId, answers.id_question, answers.contenu AS answContent, answers.id_user, users.id AS idUser, users.username
      FROM comments
      LEFT JOIN answers on answers.id=comments.id_answer
      LEFT JOIN users on users.id=answers.id_user";

    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $comments=$stmt->fetchAll();

   /* echo "<pre>";
    print_r($comments);
    echo "</pre>";
    die();*/

?>

<main class="mainContentQuestions">
<div class="maindetail">

        <div id="questionDetail">
            <h3><?php echo $question['title']; ?> postée par  <?php echo $question['username']; ?></h3>

            <div id="contenu">
            <pre><?php echo $question['contenu']; ?></pre>
            <div>
<div id="tag">
            <p class="keyword">
              <?php echo $question['keyword1']; ?>
            </p>

                <?php if(!empty($question['keyword2'])){ ?>
              <p class="keyword">
              <?php echo $question['keyword2']; ?>
                </a>
              </p>
              <?php }?>

                <?php if(!empty($question['keyword3'])){ ?>
              <p class="keyword">
                <?php echo $question['keyword3']; ?>
                </a>
              </p>
                <?php }?>

                <?php if(!empty($question['keyword4'])){ ?>
              <p class="keyword">
                <?php echo $question['keyword4']; ?>
                </a>
              </p>
                <?php }?>

                <?php if(!empty($question['keyword5'])){ ?>
              <p class="keyword">
                <?php echo $question['keyword1']; ?>
                </a>
              </p>
            <?php }?>

          </div>

        </div>
      </div>

<?php


foreach ($answers as $answer) {

      if ($_GET['id'] == $answer['id_question']) { ?>

        <div id="reponseDetail">
            <div id="contenu">
            <h2 style="font-weight: 700">Réponse postée par  <?php echo $answer['username']; ?> le <?php echo $answer['dateCreated']; ?></h2>
            <pre><?php echo $answer['contenu']; ?></pre>
            </div>
<<<<<<< HEAD
            <div id="vote">
            <form method="post" action="voter.php">
            <label for="oui">VOTER POUR LA REPONSE :></label>
            <input type="submit" name="oui" value="OUI !"/>
            <input type="submit" name="non" value="NON !"/>
            </form>



            </div>

<?php
=======
>>>>>>> d0bd4f3c871f981bfc05bc2c714ddf64cde2c3b7

 <?php

      foreach ($comments as $comment) {

            if ($comment['commAnswId'] == $comment['answId']) { ?>
            <div id="contenu">
            <h3 style="font-weight: 700">Commentaire posté par  <?php echo $comment['username']; ?> le <?php echo $comment['dateCreated']; ?></h3>
            <pre><?php echo $comment['commContent']; ?></pre>
           <?php } ?>
            </div>

        </div>

      <?php  }

 include("commenter.php");

      }

}?>

  <?php include("repondre.php") ?>


</div>
</main>



<?php include("inc/bottom.php"); ?>