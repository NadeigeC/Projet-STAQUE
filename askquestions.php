

<form id="askQuestions" method="POST" action="questions.php">

<div class="field_container">
<label for="title">TITRE
	<input type="text" placeholder="Entrez le titre de la question" id="title">
</label>
</div>

<div class="field_container">
<label for="contenu">VOTRE CONTENU
	<textarea id="contenu" cols="40" rows="20">
		
	</textarea>
</label>
</div>


 <div class="field_container">
 <input type="submit" value="ENVOYER">
 </div>


<?php
        if (!empty($errors)){
            echo '<ul class="errors">';
            foreach($errors as $error){
                echo '<li>'.$error.'</li>';
            }
            echo '</ul>';
        }
    ?>



</form>