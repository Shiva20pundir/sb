<?php
include 'check_user.php';
require_once 'config/dbConfig.php'; 
session_start();
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
	<h1>Book Tickets</h1>
	<div class="sm-card">
<?php
 	if (isset($_GET['show'])) {
	$data_query = "SELECT tbl_movieshow.show_time, tbl_movieshow.movie_id, tbl_movieshow.show_date, tbl_movie.movie_name, tbl_movie.movie_duration, tbl_movie.movie_poster FROM tbl_movieshow, tbl_movie WHERE tbl_movieshow.show_id=".$_GET['show']." AND tbl_movieshow.movie_id=tbl_movie.movie_id";
	$result = mysqli_query($dbConn, $data_query);
	$item = mysqli_fetch_assoc($result);
	$standard_time = date('h:i A', strtotime($item['show_date']." ".$item['show_time']));

	echo '<img src="movie_posters/'.$item['movie_poster'].'" class="sm-poster">
		    <div class="sm-desc">
				<h3>'.$item['show_date'].'</h3>
				<h3>'.$standard_time.'</h3>
				<h2>'.$item['movie_name'].'</h2>
				<strong>'.$item['movie_duration'].'</strong>
			</div>';
?>
	</div>
	

	<form action="book_ticket.inc.php" method="post">
		<div class="s-container">
			<h2>Platinum</h3>
<?php
 $seat_arr = [];
foreach (range('H', 'A') as $alphabet) { 
	for ($s=1; $s <= 18; $s++) { 
		$seat = $alphabet.$s;
		array_push($seat_arr, $seat);
	}
}
$booked_s_query = "SELECT seat_no FROM tbl_ticket WHERE show_id='".$_GET['show']."'";
$booked_s_result = mysqli_query($dbConn, $booked_s_query);

$booked_s_arr = array();
 
while ($booked_s_data = mysqli_fetch_assoc($booked_s_result)) {	 	
	array_push($booked_s_arr, $booked_s_data['seat_no']);
}

foreach ($seat_arr as $key => $value) {

	$stairs = array(3, 13, 21, 31, 39, 49, 57, 67, 75, 85, 93, 103, 111, 121, 129, 139);
	$breaks = array(17, 35, 53, 89, 107, 125);	

	if (in_array($value, $booked_s_arr)) {
		$seat_chkbx = "<input type='checkbox' name='seat[]' value='".$value."' class='seat booked' disabled>";
		
	}else{
		$seat_chkbx = "<input type='checkbox' name='seat[]' value='".$value."' class='seat'>";		
	}
	

	$rows = (in_array($key, $stairs)) ? $seat_chkbx."<lable class='stair'></lable>" : $seat_chkbx ;
	$next_row = (in_array($key, $breaks)) ? $seat_chkbx."<br>" : $rows ;
	$hall = ($key == 71) ? $seat_chkbx."<div class='lobby'></div><h2>Silver</h2>" : $next_row;

	echo($hall);
}
?>
	<h3 class="scrn">SCREEN</h3>
	<h2>Payment</h2>

	<div class="p-card">
		<label for="" class="user_form__lbl">Name on card:</label>
		<div class="input_box">	     
		  <input type="text"  name="ccName" min="2" max="20" class="user_form__field">
		</div>
		<label for="" class="user_form__lbl">Card no:</label>
		<div class="input_box">	     
		  <input type="text" name="card" min="2" max="20" class="user_form__field">
		</div>
		<label for="" class="user_form__lbl">Expr. date of credit card:</label>
			     
		  <select name="year">
		  	<?php
		  	
		  	for ($i=0; $i < 10; $i++) {
		  	    echo "<option value=".date('Y', strtotime("now + ".$i."year")).">
		  	         ".date('Y', strtotime("now + ".$i."year"))."</option>";
		  	}
		  	?>
		  </select>
		  <select name="month">
		  	<?php
		  	$m_arr = array('jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec');
		  	for ($i=0; $i < count($m_arr); $i++) {
		  	   
		  	    if ($i == date('m')) {
		  	    	echo "<option value=".$m_arr[$i]."  selected>".$m_arr[$i]."</option>";
		  	    } else {
		  	    	echo "<option value=".$m_arr[$i].">".$m_arr[$i]."</option>";
		  	    }
		  	    
		  	}
		  	?>
		  </select><br>
		
		  <label for="" class="user_form__lbl">cvv on card:</label>
			<div class="input_box">	     
			  <input type="text"  name="cvv" min="2" max="20" class="user_form__field">
			</div>
		</div>
	</div>
	</div>

	

    <input type="submit" name="confirm" value="Book Ticket(s)" class="submit-btn">		
	</form>	
</main>
</body>
</html>

<?php
	}
