<?php
  session_start();
  include("db.php");
  include("inc/functions.php");



    $sql = SELECT vote_type
        FROM answers
        WHERE id = 1;

    $yes = $_POST['oui'];
    $no = $_POST['non'];

     if(isset($_POST['oui'])){
        $sql = UPDATE answers
        SET vote_type = vote_type + 1
        WHERE id = 1;
    }

    $stmt=$dbh->prepare($sql);
    $stmt->execute();


     if(isset($_POST['non'])){
        $sql = UPDATE answers
        SET vote_type = vote_type - 1
        WHERE id = 1;
    }

    $stmt=$dbh->prepare($sql);
    $stmt->execute();



?>


