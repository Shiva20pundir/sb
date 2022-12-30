<?php include 'check_admin.php'; ?>
<?php
require_once '../config/dbConfig.php';
 
 $data_query = "SELECT * FROM tbl_movie";
 $result = mysqli_query($dbConn, $data_query);
 $data_rows = mysqli_num_rows($result);
  
  if ($data_rows >= 0) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<?php include '../include/nav.html'; ?>
	<main>
		<legend>Movie's List</legend>
		<table>
		<thead>
			<tr>
				<th>Poster</th>
				<th>Name</th>
				<th>Description</th>
				<th>Release Date</th>
				<th>Language</th>
				<th>Category</th>
				<th>Update | Delete</th>
			</tr>
		</thead>
		<tbody>
		<?php
		  	while ($get_productData = mysqli_fetch_assoc($result)) {
		  		echo "
		             <tr>
		              <td><img src='../movie_posters/".$get_productData['movie_poster']."' class='img-icon'></td>
		              <td>".$get_productData['movie_name']."</td>
		              <td>".$get_productData['movie_desc']."</td>
		              <td>".$get_productData['release_date']."</td>
		              <td>".$get_productData['movie_language']."</td>
		              <td>".$get_productData['movie_category']."</td>
		              <td>
		                 <a href='edit_products.php?item_id=".$get_productData['movie_id']."'>&#9998;</a>  |  
		                 <a href='delete_prdct.php?item_id=".$get_productData['movie_id']."'>&#128465;</a>
		              </td>
		             </tr>
		  		";
		  	}
  }else{
  	echo "<h3>No product found.</h3>";
  }
		?>	
			</tbody>
		</table>
	</main>
</body>
</html>

 