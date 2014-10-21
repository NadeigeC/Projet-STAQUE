
<?php 
 session_start();
 include("inc/functions.php");

 include("inc/top.php");
     
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
            // $img->desaturate()->blur()->sketch()->save("uploads/blackandwhite/" . $filename);
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

 



    //formulaire soumis ?
    if (!empty($_POST)){
        //on écrase les valeurs définies ci-dessus, tout en se protegeant
        //pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)

        $email          = strip_tags($_POST['email']);
        $username       = strip_tags($_POST['username']);
        $name           = strip_tags($_POST['name']);
        $password       = $_POST['password'];
        $password_bis   = $_POST['password_bis'];
        $country        = $_POST['country'];
        $job            = $_POST['job'];
        $language       = $_POST['language'];
        $externallink   = $_POST['externallink'];
        $id             =$_SESSION['user']['id'];

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
            $sql = "UPDATE users(name, avatar, email, username, password, salt, token, dateRegistered, dateModified, job, country, language, externallink)
                    SET (name=:name,avatar= :avatar,email= :email,username= :username,password= :password,salt= :salt,token= :token, NOW(), NOW(),job= :job,country= :country,language= :language,externallink= :externallink)
                    WHERE id=:id";

                    $stmt = $dbh->prepare($sql);
                    $stmt->bindValue(":name", $email);
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
                    $stmt->bindValue(":id",$id);

                    $stmt->execute();
                    header("Location: login.php");


        }

    }
 





      ;?>

<div class="mainContent">

<form action="register.php" method="POST" id="register_form" enctype="multipart/form-data">

                <h3>MODIFICATION DU COMPTE UTILISATEUR</h3>

                <div id="colGauche">
                <div class="field_container">
                        <label for="name">Votre nom</label>
                        <input type="text" name="name" id="name" value="<?php echo $name; ?>" />
                </div>
                <div class="field_container">
                        <label for="username">Votre pseudo</label>
                        <input type="text" name="username" id="username" value="<?php echo $username; ?>" />
                </div>
                <div class="field_container">
                        <label for="email">Votre email</label>
                        <input type="email" name="email" id="email" value="<?php echo $email; ?>" />
                </div>
                <div class="field_container">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" value="<?php echo $password; ?>" />
                </div>
                <div class="field_container">
                        <label for="password_bis">Retaper le mot de passe</label>
                        <input type="password" name="password_bis" id="password_bis" value="<?php echo $password_bis; ?>" />
                </div>
                </div>


                <div id="colDroite">
                <div class="field_container">
                        <label for="country">Pays</label>
                        <input type="text" name="country" id="country" value="<?php echo $country; ?>" />
                </div>
                <div class="field_container">
                        <label for="job">Metier</label>
                        <input type="text" name="job" id="job" value="<?php echo $job; ?>" />
                </div>
                <div class="field_container">
                        <label for="avatar">Photo</label>
                        <input type="file" name="image" id="image" value="<?php echo $avatar; ?>" />
                </div>
                <div class="field_container">
                        <label for="language">Langues</label>
                        <input type="text" name="language" id="language" value="<?php echo $language; ?>" />
                </div>
                <div class="field_container">
                        <label for="externallink">Liens Externes</label>
                        <input type="text" name="externallink" id="externallink" value="<?php echo $externallink; ?>" />
                </div>
                </div>


    <?php
        if (!empty($errors)){
            echo '<ul class="errors">';
            foreach($errors as $error){
                echo '<li>'.$error.'</li>';
            }
            echo '</ul>';
        }

        else{
            echo "modifications effectuées";
        }


    ?>
    <div class="field_container">
        <label for="sauvegarde"></label>
        <input type="submit" value="SAUVEGARDER !" class="submit" id="sauvegarde"/>
    </div>


</form>


</div>


<?php include("inc/bottom.php"); ?>
