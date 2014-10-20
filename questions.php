<?php


  session_start();
  include("db.php");
  include("inc/functions.php");

$sql="SELECT *
          FROM questions
          LEFT JOIN users on users.id=questions.id_user
          ORDER BY dateCreated DESC
          LIMIT 15";

    //envoie la requête au serveur MySQL (statement) 3 prepare
    $stmt=$dbh->prepare($sql);

    //exécute la requête 4 execute
    $stmt->execute();

    //récupère les résultats
    $questions=$stmt->fetchAll();
    //print_r($results);

?>


<?php include("inc/top.php"); ?>

<main class="mainContentQuestions">
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

              <?php
              if($question['keyword2'] == " "){ ?>
              <p style="display:none"></p> <?php }
              else { ?>
              <p class="keyword"> <?php echo $question['keyword2']; ?></p>
              <?php } ?>


              <?php
              if($question['keyword3'] == " "){ ?>
              <p style="display:none"></p> <?php }
              else { ?>
              <p class="keyword"><?php echo $question['keyword3']; ?></p>
              <?php } ?>


              <?php
              if($question['keyword4'] == " "){ ?>
              <p style="display:none"></p> <?php }
              else { ?>
              <p class="keyword"><?php echo $question['keyword4']; ?></p>
              <?php } ?>


              <?php
              if($question['keyword5'] == " "){ ?>
              <p style="display:none"></p> <?php }
              else { ?>
              <p class="keyword"><?php echo $question['keyword5']; ?></p>
              <?php } ?>



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