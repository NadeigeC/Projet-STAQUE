
<?php
	session_start();

	include("db.php");
	include("inc/functions.php");
	include("inc/top.php");


	$title = "";
	$contenu = "";
	
	$errors = array();

	if (!empty($_POST)){

		$title 		= $_POST['title'];
		$contenu 	= $_POST['contenu'];


		if (empty($title)){
            $errors[] = "Vous devez entrer un titre !";
        }
        
        if (empty($contenu)){
            $errors[] = "Vous devez renter un contenu pour valider le formulaire !";
        }

		$sql = "INSERT INTO questions(title, contenu)
                    VALUES (:title, :contenu)";

                    $stmt = $dbh->prepare($sql);
                    $stmt->bindValue(":title", $title);
                    $stmt->bindValue(":contenu", $contenu);
                    $stmt->execute();
					header("Location: index.php");

}
	
include("askquestions.php") ;?>