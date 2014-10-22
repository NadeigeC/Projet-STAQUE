<?php
    if(!isset($_SESSION)){
        session_start();
    }


    $reponse = "";
    if (!empty($_POST['reponse'])){
    $reponse = $_POST['reponse'];
	}

    $user_id 	= "";
    if (!empty($_SESSION['user']['id'])){
    $user_id = $_SESSION['user']['id'];
	}

    $quest_id = "";
    if (!empty($_GET['id'])){
    $quest_id = $_GET['id'];
	}


    if(!empty($_POST)){

        $quest_id = $_POST['quest_id'];

        include("db.php");


    	$sql = "INSERT INTO answers(contenu, id_user, id_question, dateCreated, dateModified)
	           VALUES ( :contenu, :id_user, :id_question, NOW(), NOW())";

	                    $stmt = $dbh->prepare($sql);
	                    $stmt->bindValue(":contenu", $reponse);
	                    $stmt->bindValue(":id_user", $user_id);
	                    $stmt->bindValue(":id_question", $quest_id);
	                    $stmt->execute();
	                  	header("Location: questionsDetail.php?id=$quest_id");
						die();
    }

?>

<h3>Répondre à ce post</h3>

</div>

<?php if (userIslogged()){ ?>

<form action="repondre.php" method="POST">


        <div class="field_container">


        	<input type="hidden" name="quest_id" value="<?php echo $quest_id; ?>">

            <div id="reponse">
            <pre><?php echo $reponse; ?></pre>
            <textarea value="<?php echo $reponse; ?>" id="reponse" cols="87" rows="10" name="reponse">
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
            <input type="submit" value="POSTER LA REPONSE !" id="quest">
        </div>
</form>

<?php }

else { ?>
	<p> MERCI DE VOUS CONNECTER OU DE VOUS INSCRIRE POUR REPONDRE A CE POST </p>
	<a class="login" href="login.php">CONNEXION</a> |
	<a class="signup"href="register.php">NOUVEAU COMPTE</a>
	<?php }
?>