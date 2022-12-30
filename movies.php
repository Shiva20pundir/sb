<?php 
require_once 'config/dbConfig.php';

 // 	$data_query = "SELECT movie_name, movie_desc, release_date, movie_language, movie_category, movie_trialer, movie_poster FROM tbl_movie WHERE movie_name='".str_replace('_', " ", $_GET['movie'])."'";
	// $result = mysqli_query($dbConn, $data_query);
 //    while ($movie_data = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php 
	 if (isset($_GET['category'])) {
	 	echo($_GET['category'])." movies";
	 }elseif (isset($_GET['language'])) {
	 	echo($_GET['language'])." movies";
	 }
	?></title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<main class="container">
<?php
if (isset($_GET['language'])) {
$m_data_query = "SELECT movie_language, movie_name, movie_poster, movie_duration, movie_category, release_date FROM tbl_movie WHERE movie_language='".$_GET['language']."' ORDER BY movie_id DESC LIMIT 10";
 	$query_result = mysqli_query($dbConn, $m_data_query);
 	echo "<h2>".$_GET['language']." Movies</h2>";
 	while ($m_data = mysqli_fetch_assoc($query_result)) {
 		$var1 = date('W', strtotime(date('Y-m-d')));
		$var2 = date('W', strtotime($m_data['release_date']));

		$week = $var1 - $var2;

		if ($week <= 2) {
			echo "<div class='m-page'>";     	
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
				  </div>
				 </div>";
		}
 	}
}elseif (isset($_GET['category'])) {
	$m_data_query = "SELECT movie_language, movie_name, movie_poster, movie_duration, movie_category, release_date, LOCATE('".$_GET['category']."', movie_category) FROM tbl_movie WHERE LOCATE('".$_GET['category']."', movie_category) ORDER BY movie_id DESC LIMIT 16";
 	$query_result = mysqli_query($dbConn, $m_data_query);
 	echo "<h2>".$_GET['category']." Movies</h2>";
 	while ($m_data = mysqli_fetch_assoc($query_result)) {
 		$var1 = date('W', strtotime(date('Y-m-d')));
		$var2 = date('W', strtotime($m_data['release_date']));

		$week = $var1 - $var2;

		if ($week <= 2) {

			echo "<div class='m-page'>";      	
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
				  </div>
				</div>";
		}
 	}
}
?>	
</main>
</body>
</html>