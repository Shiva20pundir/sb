<?php include 'check_admin.php'; ?>
<?php
require_once '../config/dbConfig.php';

$data_query = "SELECT movie_poster FROM tbl_movie WHERE movie_id=".$_GET['item_id']."";
$result = mysqli_query($dbConn, $data_query);
$item = mysqli_fetch_assoc($result);

if ( unlink("movie_posters/".$item['movie_poster']."")) {
    $delete_query = "DELETE FROM tbl_movie WHERE movie_id=".$_GET['item_id']."";
	mysqli_query($dbConn, $delete_query);

}else{
	$delete_query = "DELETE FROM tbl_movie WHERE movie_id=".$_GET['item_id']."";
	mysqli_query($dbConn, $delete_query); 
}

header('location: product_list.php');