<header>
	<nav>
		<div class="navbar-logo">
			<a href="index.php">&#127910; Cinemas</a>
		</div>
		<ul class="navbar-links">
			<li><a href="index.php">Home</a></li>
			<li>
				<details class="navbar-sublink">
					<summary>Languages</summary>
					<ul>
						<li><a href="movies.php?language=Hindi">Hindi</a></li>
						<li><a href="movies.php?language=English">English</a></li>
						<li><a href="movies.php?language=Telugu">Telugu</a></li>
						<li><a href="movies.php?language=Tamil">Tamil</a></li>
						<li><a href="movies.php?language=Marathi">Marathi</a></li>
						<li><a href="movies.php?language=Kannada">Kannada</a></li>
					</ul>
				</details>
			</li>
			<li>
				<details class="navbar-sublink">
					<summary>Category</summary>
					<ul>
						<li><a href="movies.php?category=Horror">Horror</a></li>
						<li><a href="movies.php?category=Comedy">Comedy</a></li>
						<li><a href="movies.php?category=Sci-fi">Sci-fi</a></li>
						<li><a href="movies.php?category=Romantic">Romantic</a></li>
						<li><a href="movies.php?category=Action">Action</a></li>
						<li><a href="movies.php?category=Drama">Drama</a></li>
					</ul>
				</details>
			</li>
			<li>
			<form action="navbar.php" method="post" class="navbar-searchbar">
				<input type="search" name="movie" list="movies" class="search-field">
				<input type="submit" name="search" value="&#128269;">
			</form>
			<datalist id="movies">
	<?php
	$mnl_data_query = "SELECT movie_name FROM tbl_movie";
	$mnl_result = mysqli_query($dbConn, $mnl_data_query);
      if (mysqli_num_rows($mnl_result) >= 0) {
      	while ($item = mysqli_fetch_assoc($mnl_result)) {
      		echo "<option>".$item['movie_name']."</option>";
        }
      }
	?>
			</datalist>
	<?php 
    if (isset($_POST['search'])) {
	 if (!empty($_POST['movie'])) {
	 	 	$movie = str_replace(" ", "_", $_POST['movie']);	 
	 		header('location: movie.php?movie='.$movie);
	 	}else{
	 		echo '<script type="text/javascript"> window.history.back(); </script>';
	 	}	 	 
	}
	?>
	        </li>	
		</ul>
	
		<details class="navbar-sublink">
			<summary>&#128100;</summary>
			<?php
			 session_start(); 
				if (isset($_SESSION['active_user'])) {
					// echo ($_SESSION['active_user']);
					echo '<ul>
							<li><h4>'.$_SESSION['active_user'].'</h4></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>';
				}else{
					// echo "&#128100;";
					echo '<ul>
							<li><a href="user_login.html">Login</a></li>
							<li><i>&nbsp; or</i></li>
							<li><a href="user_signup.html">Sign up</a></li>
						</ul>';
				}
				?>
			
		</details>
	</nav>
</header>

<footer>
	copyright@2020
</footer>