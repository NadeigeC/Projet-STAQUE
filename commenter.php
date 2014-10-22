<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $commentaire = "";
    if (!empty($_POST['commentaire'])){
    $commentaire = $_POST['commentaire'];
    }

    $user_id    = "";
    if (!empty($_SESSION['user']['id'])){
    $user_id = $_SESSION['user']['id'];
    }

    $quest_id = "";
    if (!empty($_GET['id'])){
    $quest_id = $_GET['id'];
    }

    $answer_id = "";
    if (!empty($_POST['answer_id'])){
    $answer_id = $_POST['answer_id'];
    }


    if(!empty($_POST)){

        $quest_id = $_POST['quest_id'];

         include("db.php");


        $sql = "INSERT INTO comments(contenu, id_user, id_question, id_answer, dateCreated, dateModified)
                        VALUES (:contenu, :id_user, :id_question, :id_answer, NOW(), NOW())";

                        $stmt = $dbh->prepare($sql);
                        $stmt->bindValue(":contenu", $commentaire);
                        $stmt->bindValue(":id_user", $user_id);
                        $stmt->bindValue(":id_question", $quest_id);
                        $stmt->bindValue(":id_answer", $answer_id);
                        $stmt->execute();
                              /*echo "<pre>";
                                print_r($answer_id);
                                echo "</pre>";
                                die();*/
                        header("Location: questionsDetail.php?id=$quest_id");
                        die();
    }

?>

<h4 style="font-weight: 700">Commenter la réponse</h4>

</div>

<?php if (userIslogged()){ ?>

<form action="commenter.php" method="POST">


        <div class="field_container">


            <input type="hidden" name="answer_id" value="<?php echo $answer['answId']; ?>">
            <input type="hidden" name="quest_id" value="<?php echo $quest_id; ?>">
            <input type="hidden" name="comment_id" value="<?php echo $comment['commId']; ?>">

            <div id="comment">
            
            <textarea value="<?php echo $commentaire; ?>" id="commentaire" cols="30" rows="5" name="commentaire">
            </textarea>
            <div>
<?php
                if (!empty($errors)){
                    echo '<ul class="errors">';
                    foreach($errors as $error){
                        echo '<li>'.$error.'</li>';
                    }
                    echo '</ul>';
                }
        ?>
            <label for="quest"></label>
            <input type="submit" value="POSTER LE COMMENTAIRE !">
        </div>
</form>

<?php }

else { ?>
    <p> MERCI DE VOUS CONNECTER OU DE VOUS INSCRIRE POUR REPONDRE A CE POST </p>
    <a class="login" href="login.php">CONNEXION</a> |
    <a class="signup"href="register.php">NOUVEAU COMPTE</a>
    <?php }
?>