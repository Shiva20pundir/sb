<?php
require_once '../config/dbConfig.php';

 if (isset($_POST['submit'])) {
    $time = mysqli_real_escape_string($dbConn, $_POST['show_time']);
    $date = mysqli_real_escape_string($dbConn, $_POST['show_date']);
    $movie_name = mysqli_real_escape_string($dbConn, $_POST['movie']);

    $data_query = "SELECT movie_id FROM tbl_movie WHERE movie_name = '".$movie_name."'";
	$result = mysqli_query($dbConn, $data_query);
	$get_productData = mysqli_fetch_assoc($result);

	 if (empty($time)||empty($date)||empty($movie_name)) {
        $inputs = array("show_time"=> $_POST['show_time'],
                        "show_date"=>$_POST['show_date'],
                        "movie"=>$_POST['movie']);
        $emptyInputFields = [];
       
            foreach ($inputs as $key => $value) {
                if (empty($value)) {
                  array_push($emptyInputFields, $key);
                }
            }        

        header('location: add_shows.php?error=emptyInputfields&invalidInputs='.implode("+", $emptyInputFields));
     }else{
     	$insert_query = "INSERT INTO tbl_movieshow(movie_id, show_date, show_time, screen_no)\n
                         VALUES ('".$get_productData['movie_id']."', '".$date."', '".$time."','".$_GET['scrn']."')";
		$insert_result = mysqli_query($dbConn, $insert_query);

		 header('location:add_shows.php');
     }     
 }