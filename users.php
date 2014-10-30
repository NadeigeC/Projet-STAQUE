<?php
  session_start();
  include("db.php");
  include("inc/functions.php");


		$id = "";
		$avatar = "";
		$pseudo = "";


$sql = "SELECT *
		FROM users
		";


	$stmt=$dbh->prepare($sql);
	//$stmt ->bindValue(":id", $id);
    $stmt->execute();
    $users=$stmt->fetchAll();

// echo '<pre>';
// print_r($users);
// echo '</pre>';
?>

<?php include("inc/top.php"); ?>


<main class="mainContentQuestions">

	<?php
          foreach($users as $user):
          ?>
<div class="users">

      <a href="profile.php?id='.$user['id'].'"><img src="uploads/avatar/<?php echo $user['avatar'];?>" width=60px height=60px/></a>
      <p><?php echo $user['username']; ?></p>
      <p>membre depuis le <?php
              $unix = strtotime($user['dateRegistered']);
                        echo date("d-m-Y", $unix); ?></p>
</div>
    <?php endforeach; ?>


</main>

<div class="clearboth"></div>

<?php include("inc/bottom.php"); ?>
