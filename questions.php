<?php
  session_start();
  include("db.php");
  include("inc/functions.php");

  $numPerPage = 15;
  $page = 1;

  if (!empty($_GET['page'])){
        $page = $_GET['page'];
      }

  $offset = ($page-1)*$numPerPage;

  $direction = "ASC";
  if (!empty($_GET['dir'])){
    if ($_GET['dir'] === "desc"){
      $direction = "DESC";

$sql="SELECT *
          FROM questions
          LEFT JOIN users on users.id=questions.id_user
          ORDER BY dateCreated DESC
          LIMIT :offset, $numPerPage";

    $stmt=$dbh->prepare($sql);
    $stmt->bindValue(":offset", ($page-1)*$numPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $questions=$stmt->fetchAll();


$sql = "SELECT COUNT(*) FROM questions";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $totalNumber = $stmt->fetchColumn();
    $totalPages = ceil($totalNumber / $numPerPage); //arrondi par le haut


    }
  }

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


<?php
    for($i= ($page-5); $i < ($page+5); $i++){
      if($i <1 || $i > $totalPages){continue;}
    echo '<a href="questions.php?dir=' .strtolower($direction) . '&page=' . $i .'">' .$i . '</a>';

  }
  ?>

      <a href="questions.php?dir=<?php echo strtolower($direction); ?>&page=<?php echo $totalPages; ?>">>></a>

<?php if($page >= 2){ ?>
      <a href="questions.php?page=<?php echo strtolower($direction); ?>&page=<?php echo $page - 1 ?>">Page précédente</a>
<?php } ?>

<?php if($page < $totalPages){ ?>
      <a href="questions.php?page=<?php echo strtolower($direction); ?>&page=<?php echo $page + 1 ?>">Page suivante</a>
<?php } ?>
















      </main>



      <?php include("inc/bottom.php"); ?>