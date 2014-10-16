<?php include("../inc/top.php"); ?>

<body>

	<div id="wrapper">

		<nav id="head">
		
		<?php	
			if (userIsLogged()){
			echo "Yo " . $_SESSION['user']['username'] . "!";
			echo ' <a href="logout.php" title="Logout !" style="display:block">Logout</a>';
			}
		else {
		?>
			<a class="login" href="pages/login.php"><button>Log In</button></a>
		<?php } ?>
			
			<h1>Stackoverflone</h1>
			<input type="text" name="search" value="Search">
			
		</nav>
		<main>
			<div class="mainContent">
				<a href="questions.php"><button>Questions</button></a>
				<a href="askquestions.php"><button>Ask Question</button></a>
				<a href="logout.php"><button>Déconnexion</button></a>
				<a class="signup"href="register.php"><button>Sign up</button></a>
			<div>
		</main>
		<footer>
			<div id="foot">
				<div class="topfoot">
					<a href="">help |</a>
					<a href="">chat |</a>
					<a href="">data |</a>
					<a href="">legal |</a>
					<a href="">privacy policy |</a>
					<a href="">work here |</a>
					<a href="">advertising info |</a>
					<a href="">contact us |</a>
					<a href="">feedback </a>
				</div>
				<div class="contentfoot">
				<h3>TECHNOLOGY</h3>
				<div class="leftfoot">
					<a href="">Stack Overflow</a>
					<a href="">Server Fault</a>
					<a href="">Super user</a>
					<a href="">Web Applications</a>
					<a href="">Ask Ubuntu</a>
				</div>
				<div class="rightfoot">
					<a href=""> Webmasters</a><br/>
					<a href="">Game Development</a><br/>
					<a href="">programmers</a><br/>
					<a href="">WordPress Development</a><br/>
					<a href="">Information security</a>
				</div>
				</div>
				<div id="copy">
					<p>Site design/ logo &copy; <?php echo date("Y"); ?> staque corporation; user  contributions licensed under <a href=""> ccby-sa 3.0</a>
				</div>	
			</div>	
			
		</footer>

=======
		<nav id="form_sign">
			<a id="btn1" href="register.php">SIGN UP</a>
			<a id="btn2" href="login.php">LOG IN</a>
			<input type="text" name="search">
		</nav>
		<main>
			<div>
				<h1>Stackoverflone</h1>
				<a href="questions.php"><button>Questions</button></a>
				<a href="tags.php"><button>Tags</button></a>
				<a href="users.php"><button>Users</button></a>
				<a href="unanswered.php"><button>Unanswered</button></a>
				<a href="askquestions.php"><button>Ask Question</button></a>
			<div>
		</main>
		<footer>
			<nav>
				<a href="">tour</a>
				<a href="">help</a>
				<a href="">chat</a>
				<a href="">data</a>
				<a href="">legal</a>
				<a href="">privacy policy</a>
				<a href="">work here</a>
				<a href="">advertising info</a>
				<a href="">contact us</a>
				<a href="">feedback</a>
			</nav>
			<h3>TECHNOLOGY</h3>
				<a href="">Stack Overflow</a>
				<a href="">Server Fault</a>
				<a href="">Super user</a>
				<a href="">Web Applications</a>
				<a href="">Ask Ubuntu</a>
				<a href=""> Webmasters</a>
				<a href="">Game Development</a>
				<a href="">programmers</a>
				<a href="">WordPress Development</a>
				<a href="">Information security</a>

			<p>Site design/ logo &copy; <?php echo date("Y"); ?> staque coproration; user  contributions licensed under <a href=""> ccby-sa 3.0</a>
		</footer>


	</div>
</body>
</html>

