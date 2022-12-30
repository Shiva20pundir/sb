<?php
require_once '../config/dbConfig.php';

$delete_query = "DELETE FROM tbl_movieshow WHERE show_id = ".$_GET['show']."";
mysqli_query($dbConn, $delete_query);

header('location: delete_show.php');