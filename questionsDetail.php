
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

$sql="SELECT *
      FROM questions
      WHERE id= :id";

    $stmt=$dbh->prepare($sql);
    $stmt ->bindValue(":id", $id);
    $stmt->execute();

    //récupère les résultats
    $question=$stmt->fetch();

?>

<main class="mainContentQuestions">
<div class="maindetail">

        <div id="questionDetail">
            <h3><?php echo $question['title']; ?></h3>

            <?php echo $question['$contenu']; ?>

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



<form action="repondre.php" method="POST">

        <?php
                if (!empty($errors)){
                    echo '<ul class="errors">';
                    foreach($errors as $error){
                        echo '<li>'.$error.'</li>';
                    }
                    echo '</ul>';
                }
        ?>
        <div class="field_container">
            <label for="quest"></label>
            <input type="submit" value="POSTER LA QUESTION !" id="quest">
        </div>
</form>
</div>
</main>



<?php include("inc/bottom.php"); ?>