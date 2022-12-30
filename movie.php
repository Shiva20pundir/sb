<?php 
require_once 'config/dbConfig.php';
if (isset($_GET['movie'])) {
 	$data_query = "SELECT movie_name, movie_desc, release_date, movie_language, movie_category, movie_trialer, movie_poster FROM tbl_movie WHERE movie_name='".str_replace('_', " ", $_GET['movie'])."'";
	$result = mysqli_query($dbConn, $data_query);
    while ($movie_data = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo(str_replace('_', " ", $_GET['movie'])); ?></title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<main class="container">
<section class="m-flex">
<?php
     	
echo '<img src="movie_posters/'.$movie_data['movie_poster'].'" class="img">     	      
      <div class="details">
      	<h1>'.$movie_data['movie_name'].'</h1>
	      <p class="text">'.$movie_data['movie_desc'].'</p>
	      <h3>'.$movie_data['release_date'].'</h3>
	      <strong>'.$movie_data['movie_language'].'</strong>
	      <p>'.$movie_data['movie_category'].'</p>
      </div>';
?>
</section>

<section class="t-screen">
	
	<?php
	 echo '<iframe src="'.$movie_data['movie_trialer'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
	?>
</section>
<?php
     }
}
?>
<div class="m-shows">
	
			<?php
			$val = '';
			
			$d_query = "SELECT tbl_movieshow.show_date FROM tbl_movie, tbl_movieshow WHERE tbl_movie.movie_name='".str_replace('_', " ", $_GET['movie'])."' AND tbl_movie.movie_id=tbl_movieshow.movie_id ORDER BY tbl_movieshow.show_date DESC";
			$d_result = mysqli_query($dbConn, $d_query);
			$data_arr = [];

			while ($data = mysqli_fetch_assoc($d_result)) {
				array_push($data_arr, $data['show_date']);
			}

			foreach (array_unique($data_arr) as $key => $value) {
			  echo "<div class='box'>";
			   if ($value !== FALSE) {
			   	echo "<h3>".($value)."</h3>";
				  $query = "SELECT tbl_movieshow.show_id, tbl_movieshow.show_time FROM `tbl_movieshow`, tbl_movie WHERE tbl_movie.movie_name='".str_replace('_', " ", $_GET['movie'])."' AND tbl_movieshow.show_date='".$value."' ORDER BY `tbl_movieshow`.`show_time` ASC";
				  $result = mysqli_query($dbConn, $query);
				  echo "<ul class='show-b'>";
				    while ($detail = mysqli_fetch_assoc($result)) {
				    	echo "<li class='show-info'><a href='book_ticket.php?show=".$detail['show_id']."' class='show'>".substr($detail['show_time'], 0,5)."</a>
				    	      </li>";
					}
				  echo "</ul>";
			   }else{
			   		echo "<h4>Shows are not available.</h4>";
			   }
			  echo "</div>";
			}
			?>
			
</div>

</main>
</body>
</html>