
<form action="askquestions.php" id="askQuestions" method="POST" >

            <h3>POSEZ VOTRE QUESTION</h3>


        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">


        <div class="field_container">
        <label for="title">TITRE</label>
        	<input type="text" value="<?php echo $title; ?>" placeholder="Entrez le titre de la question" name="title" id="title">

        </div>

        <div class="field_container">
        <label for="contenu">VOTRE CONTENU</label>
<<<<<<< HEAD
        	<textarea value="<?php echo $contenu; ?>" id="contenu" cols="50" rows="10" name="contenu">
=======
        	<textarea value="<?php echo $contenu; ?>" id="contenu" cols="87" rows="10" name="contenu" class="key">
>>>>>>> 5bae410beb29d4fea782c8e14b751bc64ad55127
         	</textarea>

        </div>


            <div class="field_container" class="keywords">
                <label for="keyword1">MOT-CLEF 1</label>
                    <input type="text" id="keyword1" name="keyword1" value="<?php echo $keyword1; ?>" class="key">
                    <!-- <select id="keyword1" name="keyword1">
                              <option value="">Mot-clef 1</option>
                              <option value=""><?php  $keyword1; ?></option>
                    </select> -->
            </div>

            <div class="field_container" class="keywords">
            <label for="keyword2">MOT-CLEF 2</label>
            <input type="text" id="keyword2" name="keyword2" value="<?php echo $keyword2; ?>" class="key">
                <!-- <select id="keyword2" name="keyword2">
                              <option value="">Mot-clef 2</option>
                              <option value=""><?php  $keyword2; ?></option>
                </select> -->
            </div>

            <div class="field_container" class="keywords">
            <label for="keyword3">MOT-CLEF 3</label>
            <input type="text" id="keyword3" name="keyword3" value="<?php echo $keyword3; ?>" class="key">
                <!-- <select id="keyword3" name="keyword3">
                              <option value="">Mot-clef 3</option>
                              <option value=""><?php  $keyword3; ?></option>
                </select> -->

            </div>

            <div class="field_container" class="keywords">
            <label for="keyword4">MOT-CLEF 4</label>
            <input type="text" id="keyword4" name="keyword4" value="<?php echo $keyword4; ?>" class="key">
                <!-- <select id="keyword4" name="keyword4">
                              <option value="">Mot-clef 4</option>
                              <option value=""><?php insertKeyword($keyword4); ?></option>
                </select> -->

            </div>

            <div class="field_container" class="keywords">
            <label for="keyword5">MOT-CLEF 5</label>
            <input type="text" id="keyword5" name="keyword5" value="<?php echo $keyword5; ?>">
                <!-- <select id="keyword5" name="keyword5">
                              <option value="">Mot-clef 5</option>
                              <option value=""><?php echo $keyword5; ?></option>
                </select> -->

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
        <div class="field_container">
            <label for="quest"></label>
            <input type="submit" value="POSTER LA QUESTION !" id="quest">
        </div>


</form>


