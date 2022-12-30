<?php 
require_once '../config/dbConfig.php';

  	$mnl_data_query = "SELECT movie_id, movie_poster, movie_name, release_date, movie_language, movie_duration FROM tbl_movie";
	$mnl_result = mysqli_query($dbConn, $mnl_data_query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Show</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<?php include '../include/nav.html'; ?>
<main>

<div class="tab-container">
	<div class="tab-btn" data-forTab="1">Screen no. 1</div>
	<div class="tab-btn" data-forTab="2">Screen no. 2</div>
	<div class="tab-btn" data-forTab="3">Screen no. 3</div>

		<?php

		 for ($i=1; $i <= 3; $i++) { 
		?>

		<div class="tab-content" data-tab="<?php echo($i); ?>">
		<fieldset>
		<legend>Screen No. <?php echo($i); ?></legend>
		<form action="add_shows.inc.php?scrn=<?php echo($i); ?>" method="post">
			<div class="tab-panel">
			<?php
			$val = '';
			
			$d_query = "SELECT show_date FROM tbl_movieshow WHERE screen_no='".$i."' ORDER BY show_date DESC";
			$d_result = mysqli_query($dbConn, $d_query);
			$data_arr = [];

			while ($data = mysqli_fetch_assoc($d_result)) {
				array_push($data_arr, $data['show_date']);
			}

			foreach (array_unique($data_arr) as $key => $value) {
			  echo "<p class='show-date'>".($value)."</p>";
			  $query = "SELECT show_id, show_time, movie_id FROM `tbl_movieshow` WHERE show_date='".$value."' AND screen_no='".$i."' ORDER BY show_time ASC";
			  $result = mysqli_query($dbConn, $query);
			  echo "<ul class='show-board'>";
			    while ($detail = mysqli_fetch_assoc($result)) {
			    	echo "<li class='show-info'><label class='show-time'>".substr($detail['show_time'], 0,5)."</label>";
			     	// echo($detail['movie_id']);
			     	$m_query = "SELECT movie_name FROM `tbl_movie` WHERE movie_id='".$detail['movie_id']."'";
			        $m_result = mysqli_query($dbConn, $m_query);
			        $m_dta = mysqli_fetch_assoc($m_result);

				    echo "<strong class='show-movie'>".$m_dta['movie_name']."</strong>
				          </li>";
				}
			  echo "</ul>";
			}

			$t_query = "SELECT tbl_movieshow.show_time, tbl_movieshow.show_date, tbl_movie.movie_duration, tbl_movieshow.movie_id, tbl_movie.movie_id FROM `tbl_movieshow`, tbl_movie WHERE tbl_movieshow.movie_id=tbl_movie.movie_id AND tbl_movieshow.screen_no='".$i."' ORDER BY tbl_movieshow.show_date DESC, tbl_movieshow.show_time ASC";
			$t_result = mysqli_query($dbConn, $t_query);
			$t_dta = mysqli_fetch_assoc($t_result);

			if ($t_dta['show_date'] === date('Y-m-d')) {
			    preg_match_all('!\d+!', $t_dta['movie_duration'], $matches);
			    $hr = ($matches[0][0]+1)*3600;
				$sc = ($matches[0][1] + 10)*60;
				$add = $hr + $sc;
				$sum = strtotime(substr($t_dta['show_time'], 0, 5)) + intval($add);	
			    $val = gmdate("H:i", $sum);
			}
			?>
			</div>					
			<input type="date" name="show_date" value="<?php echo(date('Y-m-d')); ?>">

			<input type="time" name="show_time" value="<?php echo($val); ?>">
			<p class="input-box"><input type="text" name="movie" list="movies" class="form-elmt"></p>

			<input type="submit" name="submit" class="btn align-left">		
	    </form>
	    </fieldset>

	    </div>

		<?php
		  } 

		?>
</div>
<div class="right">
	<h2>Movie shows</h2>

	<?php 
    $query = "SELECT show_date FROM tbl_movieshow ORDER BY show_date ASC";
	$result = mysqli_query($dbConn, $query);

	$dt_arr = [];

	while ($data = mysqli_fetch_assoc($result)) {
		
		array_push($dt_arr, $data['show_date']);
	}

	foreach (array_unique($dt_arr) as $date) {
		echo "<p class='show-date'>".$date."</p>";

		$m_arr = [];
		$m_query = "SELECT movie_id FROM tbl_movieshow WHERE show_date='".$date."' ORDER BY movie_id DESC";
	    $m_result = mysqli_query($dbConn, $m_query);

	    while ($m_data = mysqli_fetch_assoc($m_result)) {
	    	array_push($m_arr, $m_data['movie_id']);
	    }
		$m_count = array_count_values($m_arr);

		echo "<ul class='show-board'>";
		foreach ($m_count as $movie => $count) {

			$mn_query = "SELECT movie_name FROM tbl_movie WHERE movie_id='".$movie."'";
			$mn_res = mysqli_query($dbConn, $mn_query);
			$mn_dt = mysqli_fetch_assoc($mn_res);

			echo "<li class='show-info'> <strong class='show-movie'>".$mn_dt['movie_name']."</strong><label class='show-time'>".$count."</label></li>";
		}
		echo "</ul>";

	}

    ?>
</div>
<datalist id="movies">
	<?php 
      if (mysqli_num_rows($mnl_result) >= 0) {
      	while ($item = mysqli_fetch_assoc($mnl_result)) {
      		echo "<option>".$item['movie_name']."</option>";
        }
      }
	?>
</datalist>


</main>
</body>
</html>
<script type="text/javascript">
	const tab_btn = document.querySelectorAll('.tab-btn');
	const tab_content = document.querySelectorAll('.tab-content');

	const toggleTabs = () => {

		  Array.from(tab_btn).forEach(button=> {
		  	button.addEventListener('click', () => {
				const tabNo = button.dataset.fortab;
				const tabToActive = document.querySelector(`.tab-container .tab-content[data-tab="${tabNo}"]`);

				const tabContainer = document.querySelector('.tab-container');

				tabContainer.querySelectorAll('.tab-btn').forEach(button => {
					button.classList.remove('btn-active');
				});


				tabContainer.querySelectorAll('.tab-content').forEach(tab => {
					tab.classList.remove('tab-active');
				});

				tabToActive.classList.add('tab-active');
				button.classList.add('btn-active');
		    });
		  });
	};

	

	document.addEventListener('DOMContentLoaded', () => {
		toggleTabs();
		document.querySelectorAll('.tab-container').forEach(contianer => {
			contianer.querySelector('.tab-btn').click();
		})
	});
</script>