<?php 
require_once 'config/dbConfig.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<main class="container">
<section class="slider-container ">
	<img src="img/image1.jpg" class="slider-img slider-active-img">
	<img src="img/image2.jpg" class="slider-img ">
	<img src="img/image3.jpg" class="slider-img ">
</section>

<h2>Latest Release</h2>
<div class="m-row">
<?php
 
 $lang_query = "SELECT movie_language FROM tbl_movie";
 $l_query_result = mysqli_query($dbConn, $lang_query); 
 $m_lang = [];

 while ($l_data = mysqli_fetch_assoc($l_query_result)) {
 	array_push($m_lang, $l_data['movie_language']);
 }
 
 foreach (array_unique($m_lang) as $key => $lang) {
 	
 	$m_data_query = "SELECT movie_language, movie_name, movie_poster, movie_duration, movie_category, release_date FROM tbl_movie WHERE movie_language='".$lang."' ORDER BY movie_id DESC LIMIT 2";
 	$query_result = mysqli_query($dbConn, $m_data_query);
 	
 	while ($m_data = mysqli_fetch_assoc($query_result)) {
 		$var1 = date('W', strtotime(date('Y-m-d')));
		$var2 = date('W', strtotime($m_data['release_date']));

		$week = $var1 - $var2;

		if ($week <= 2) {
     	
			echo "<div class='m-card' data-url='movie.php?movie=".str_replace(' ', '_', $m_data['movie_name'])."'>
			      <span class='c-tooltip'>".$m_data['movie_name']."</span>
				  <img src='movie_posters/".$m_data['movie_poster']."' class='m-poster'> 
				   <div class='m-desc'>";
			if (strlen($m_data['movie_name']) >= 12) {
				echo "<strong class='m-title'>".substr($m_data['movie_name'], 0,12)."...</strong>";
			}else{
				echo "<strong class='m-title'>".$m_data['movie_name']."</strong>";
			}					  	
			    echo "<p>".$m_data['movie_duration']."</p>
					  <p>".$m_data['movie_language']."</p>
					  <p>".$m_data['movie_category']."</p>
				   </div>
				  </div>";
		}
 	}
 }
?>
</div>

<h2>Upcoming Movies</h2>
<div class="m-row">
<?php
 
 $lang_query = "SELECT movie_language FROM tbl_movie";
 $l_query_result = mysqli_query($dbConn, $lang_query); 
 $m_lang = [];

 while ($l_data = mysqli_fetch_assoc($l_query_result)) {
 	array_push($m_lang, $l_data['movie_language']);
 }
 
 foreach (array_unique($m_lang) as $key => $lang) {
 	
 	$m_data_query = "SELECT movie_language, movie_name, movie_poster, movie_duration, movie_category, release_date FROM tbl_movie WHERE movie_language='".$lang."' ORDER BY movie_id ASC LIMIT 5";
 	$query_result = mysqli_query($dbConn, $m_data_query);
 	
 	while ($m_data = mysqli_fetch_assoc($query_result)) {
 		$var1 = date('W', strtotime(date('Y-m-d')));
		$var2 = date('W', strtotime($m_data['release_date']));

		$week = $var1 - $var2;

		if ($week <= 0) {
			echo "<div class='m-card' data-url='movie.php?movie=".str_replace(' ', '_', $m_data['movie_name'])."'>
			      <span class='c-tooltip'>".$m_data['movie_name']."</span>
				  <img src='movie_posters/".$m_data['movie_poster']."' class='m-poster'> 
				   <div class='m-desc'>";
			if (strlen($m_data['movie_name']) >= 12) {
				echo "<strong class='m-title'>".substr($m_data['movie_name'], 0,13)."...</strong>";
			}else{
				echo "<strong class='m-title'>".$m_data['movie_name']."</strong>";
			}					  	
			    echo "<p>".$m_data['movie_duration']."</p>
					  <p>".$m_data['movie_language']."</p>
					  <p>".$m_data['movie_category']."</p>
				   </div>
				  </div>";
		}
 	}
 }
// $divide = date_parse_from_format("Y-m-d",$data['release_date']);
// print_r($divide);

?>
</div>
<h2>Hollywood Movies</h2>
<div class="m-row">
	<?php 
     
 	$h_data_query = "SELECT movie_language, movie_name, movie_poster, movie_duration, movie_category, release_date FROM tbl_movie WHERE movie_language='English' ORDER BY movie_id DESC LIMIT 5";
 	$h_query_result = mysqli_query($dbConn, $h_data_query);
 	
 	while ($h_data = mysqli_fetch_assoc($h_query_result)) {
 		$var1 = date('W', strtotime(date('Y-m-d')));
		$var2 = date('W', strtotime($h_data['release_date']));

		$week = $var1 - $var2;

		if ($week <= 2) {
			echo "<div class='m-card' data-url='movie.php?movie=".str_replace(' ', '_', $h_data['movie_name'])."'>
			      <span class='c-tooltip'>".$h_data['movie_name']."</span>
				  <img src='movie_posters/".$h_data['movie_poster']."' class='m-poster'> 
				   <div class='m-desc'>";
			if (strlen($h_data['movie_name']) >= 12) {
				echo "<strong class='m-title'>".substr($h_data['movie_name'], 0,12)."...</strong>";
			}else{
				echo "<strong class='m-title'>".$h_data['movie_name']."</strong>";
			}					  	
			    echo "<p>".$h_data['movie_duration']."</p>
					  <p>".$h_data['movie_language']."</p>
					  <p>".$h_data['movie_category']."</p>
				   </div>
				  </div>";
		}
 	}
	?>
</div>
<h2>Bollywood Movies</h2>
<div class="m-row">
	<?php 
     
 	$b_data_query = "SELECT movie_language, movie_name, movie_poster, movie_duration, movie_category, release_date FROM tbl_movie WHERE movie_language='Hindi' ORDER BY movie_id DESC LIMIT 5";
 	$b_query_result = mysqli_query($dbConn, $b_data_query);
 	
 	while ($b_data = mysqli_fetch_assoc($b_query_result)) {
 		$var1 = date('W', strtotime(date('Y-m-d')));
		$var2 = date('W', strtotime($b_data['release_date']));

		$week = $var1 - $var2;

		if ($week <= 2) {
			echo "<div class='m-card' data-url='movie.php?movie=".str_replace(' ', '_', $b_data['movie_name'])."'>
			      <span class='c-tooltip'>".$b_data['movie_name']."</span>
				  <img src='movie_posters/".$b_data['movie_poster']."' class='m-poster'> 
				   <div class='m-desc'>";
			if (strlen($b_data['movie_name']) >= 12) {
				echo "<strong class='m-title'>".substr($b_data['movie_name'], 0,12)."...</strong>";
			}else{
				echo "<strong class='m-title'>".$b_data['movie_name']."</strong>";
			}					  	
			    echo "<p>".$b_data['movie_duration']."</p>
					  <p>".$b_data['movie_language']."</p>
					  <p>".$b_data['movie_category']."</p>
				   </div>
				  </div>";
		}
 	}
	?>
</div>
</main>
</body>
</html>
<script type="text/javascript" src="js/user.js"></script>
