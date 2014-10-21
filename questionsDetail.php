
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
  questions.keyword1, questions.keyword2, questions.keyword3, questions.keyword4, questions.keyword5,
  users.id AS idUser, users.name, users.avatar, users.email, users.username, users.password, users.job, users.country, users.language, users.externallink
      FROM questions
      LEFT JOIN users on users.id=questions.id_user
      WHERE questions.id= :id";

    $stmt=$dbh->prepare($sql);
    $stmt ->bindValue(":id", $id);
    $stmt->execute();

    //récupère les résultats
    $question=$stmt->fetch();

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

      
        
<?php include("repondre.php") ?>


</div>
</main>



<?php include("inc/bottom.php"); ?>