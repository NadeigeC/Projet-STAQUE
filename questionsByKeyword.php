<?php

  session_start();
  include("db.php");
  include("inc/functions.php");
  include("inc/top.php");


  $key = "";
  if (!empty($_GET['keyword'])){
    $key = $_GET['keyword'];
  }


  $numPerPage = 6;
  $page = 1;

  if (!empty($_GET['page'])){
        $page = $_GET['page'];
      }

  $offset = ($page-1)*$numPerPage;

  $direction = "ASC";
  if (!empty($_GET['dir'])){
    if ($_GET['dir'] === "desc"){
      $direction = "DESC";}
}
$sql="SELECT *
          FROM questions
          LEFT JOIN users on users.id=questions.id_user
          WHERE keyword1 = :keyword
          OR keyword2 = :keyword
          OR keyword3 = :keyword
          OR keyword4 = :keyword
          OR keyword5 = :keyword
          ORDER BY dateCreated DESC
          LIMIT :offset, $numPerPage";

    $stmt=$dbh->prepare($sql);
    $stmt->bindValue(":offset", ($page-1)*$numPerPage, PDO::PARAM_INT);
    $stmt->bindValue(":keyword", $key);
    $stmt->execute();
    $questions=$stmt->fetchAll();


$sql = "SELECT COUNT(*) FROM questions";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $totalNumber = $stmt->fetchColumn();
    $totalPages = ceil($totalNumber / $numPerPage); //arrondi par le haut

?>

<main class="mainContentQuestions">
<div class="maindetail">
        <?php
          foreach($questions as $question):

          ?>
        <div class="vote">

        </div>

        <div class="questions">

          <a href="questionsDetail.php?id=<?php echo $question['id']; ?>"> <?php echo $question['title']; ?>
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
              <a href=""><?php echo $question['username']; ?></a>

            </div>

          </div>

        </div>
        <?php endforeach; ?>


<div id="pagination">
                      <?php if($page >= 2){ ?>
                            <a href="questionsByKeyword.php?page=<?php echo strtolower($direction); ?>&<?php echo $_SERVER['QUERY_STRING']; ?>&page=<?php echo $page - 1 ?>">Page précédente</a>
                      <?php } ?>

                                    <a href="questionsByKeyword.php?dir=<?php echo strtolower($direction); ?>&<?php echo $_SERVER['QUERY_STRING']; ?>&page=1"><<</a>
                      <?php
                          for($i= ($page-2); $i < ($page+2); $i++){
                            if($i <1 || $i > $totalPages){continue;}
                          echo '<a href="questionsByKeyword.php?dir=' .strtolower($direction) . '&page=' . $i .'">' .$i . '</a>';

                        }
                        ?>
                            <a href="questionsByKeyword.php?dir=<?php echo strtolower($direction); ?>&<?php echo $_SERVER['QUERY_STRING']; ?>&page=<?php echo $totalPages; ?>">>></a>

                      <?php if($page < $totalPages){ ?>
                            <a href="questionsByKeyword.php?page=<?php echo strtolower($direction); ?>&<?php echo $_SERVER['QUERY_STRING']; ?>&page=<?php echo $page + 1 ?>">Page suivante</a>
                      <?php } ?>
                      </div>
</div>

      </main>


      <?php include("inc/bottom.php"); ?>