<?php
	session_start();

	include("db.php");
	include("inc/functions.php");

	// echo '<pre>';
 	// print_r($_FILES);
 	// echo '</pre>';

 	$imageUpload=1;

if (!empty($_FILES)){

	if($_FILES['image']['error']==4){
		$imageUpload=0;
	}


	if ($imageUpload==1){



        $accepted = array("image/jpeg", "image/jpg", "image/gif", "image/png");

        $tmp_name = $_FILES['image']['tmp_name'];

        $parts = explode(".", $_FILES['image']['name']);
        $extension = end($parts);
        $filename = uniqid() . "." . $extension;
        $destination = "uploads/" . $filename;

        // Retourne le type mime
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tmp_name);
        finfo_close($finfo);

        //mime type accepté ici ???
        if (in_array($mime, $accepted)){
            move_uploaded_file($tmp_name, $destination);

            //manipulation de l'image
            //avec SimpleImage
            require("SimpleImage.php");

            $img = new abeautifulsite\SimpleImage($destination);
            $img->thumbnail(300,300)->save("uploads/avatar/" . $filename);
            // $img->thumbnail(50,50)->save("uploads/miniature/" . $filename);
            }
        }

	}

	//déclaration des variables du formulaire
	$email = "";
    $username = "";
    $password = "";
    $password_bis = "";
    $country = "";
    $name = "";
    $job = "";
    $language = "";
    $externallink = "";
    $avatar = "";

    include("inc/top.php");



	//formulaire soumis ?
	if (!empty($_POST)){
		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)

		$email          = strip_tags($_POST['email']);
        $username       = strip_tags($_POST['username']);
        $name           = strip_tags($_POST['name']);
        $password       = $_POST['password'];
        $password_bis   = $_POST['password_bis'];
        $country       	= $_POST['country'];
        $job       		= $_POST['job'];
        $language       = $_POST['language'];
        $externallink   = $_POST['externallink'];

        if ($imageUpload==1){
        $avatar = $filename;
    		}

		$errors = array();
		//validation

		//email
		if (empty($email)){
			$errors[] = "Please provide an email !";
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Your email is not valid !";
		}
		elseif (emailExists($email)){
			$errors[] = "This email already exists !";
		}

		//username
		if (empty($username)){
			$errors[] = "Please provide an username !";
		}
		//vérifie si username est présent en bdd
		elseif (usernameExists($username)){
			$errors[] = "This username already exists !";
		}

		//password
		if (empty($password)){
			$errors[] = "Please choose a password !";
		}
		elseif (empty($password_bis )){
			$errors[] = "Please confirm your password !";
		}
		elseif ($password_bis  != $password){
			$errors[] = "Your passwords do not match !";
		}
		elseif (strlen($password) < 7){
			$errors[] = "Your password should have at least 7 characters !";
		}


		//form valide ?
		if (empty($errors)){
			//prépare les données pour l'insertion en base

			//génère un salt unique pour cet user
			$salt = randomString();

			//fonction déclarée dans functions.php
			$hashedPassword = hashPassword($password, $salt);

			//utilisée pour l'oubli du mdp, le remember me...
			$token = randomString();

			//sql d'insertion de l'user
			$sql = "INSERT INTO users(name, avatar, email, username, password, salt, token, dateRegistered, dateModified, job, country, language, externallink, score)
                    VALUES (:name, :avatar, :email, :username, :password, :salt, :token, NOW(), NOW(), :job, :country, :language, :externallink, 5)";

                    $stmt = $dbh->prepare($sql);
                    $stmt->bindValue(":name", $name);
                    $stmt->bindValue(":avatar", $avatar);
                    $stmt->bindValue(":email", $email);
                    $stmt->bindValue(":username", $username);
                    $stmt->bindValue(":password", $hashedPassword);
                    $stmt->bindValue(":salt", $salt);
                    $stmt->bindValue(":token", $token);
                    $stmt->bindValue(":job", $job);
                    $stmt->bindValue(":country", $country);
                    $stmt->bindValue(":language", $language);
                    $stmt->bindValue(":externallink", $externallink);

                    $stmt->execute();
                    header("Location: login.php");


		}

	}


?>
<?php include("inc/register_form.php") ;?>

<?php include("inc/bottom.php"); ?>