<?php
session_start();
include("inc/top.php");
include("db.php");
include("functions.php");

if(empty($_GET['id'])){
	die("404");
}

$backLinkParams = $_SERVER['QUERY_STRING'];
$backLinkParams = preg_replace("#id=[0-9]+&#", "", $backLinkParams);

$films = getMovieById( $_GET['id'] );	
?>
<?php include("top.php"); ?>
	<div id="content">
		<div id="poster">
			<img src="posters/<?php echo $films['id'];?>.jpg" alt="<?= $films['title']; ?>"/>
			<p>Rating:<?php echo $films['rating'];?>%</p>
			<!-- <progress value="<?php //echo $films['rating'];?>" max="100" ><?php //echo $films['rating']. "%"; ?></progress> -->
			<div id="rating_container">
			<div id="rating" style="width: <?= $films['rating']*2; ?>px"></div>
			</div>
		</div>
		<div id="description" >
			<div class="details"><u>Titre</u>: <?php echo $films['title'];?></div>
			<div class="details"><u>Directors</u>: <?php echo $films['directors'];?></div>
			<div class="details"><u>Writers</u>: <?php echo $films['writers'];?></div>
			<div class="details"><u>Popularity</u>: <?php echo $films['popularity'];?></div>
			<div class="details"><u>Genres</u>: <?php echo $films['genres'];?></div>
			<div class="details"><u>Cast</u>: <?php echo $films['cast'];?></div>
			<div class="details"><u>Plot</u>: <?php echo $films['plot'];?></div>
		</div>
		<a href="index.php?<?php echo $backLinkParams ?>" id="back">Retour</a>
		<?php if (userIsLogged()): ?>
			<div>
			<a href="save_movie.php?id=<?php echo $movie['id']; ?>" title="Add to my favorites">ADD THIS MOVIE !</a>
			</div>
		<?php endif; ?>
	</div>	
		<script src="../js/jquery.js"></script>
		<script src="js/ajax.js"></script>
		<script src="js/app.js"></script>
	</body> 
	</html>