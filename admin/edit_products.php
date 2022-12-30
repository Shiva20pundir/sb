<?php include 'check_admin.php'; ?>
<?php
require_once '../config/dbConfig.php';
 
 if (isset($_GET['item_id'])) {
 	 $data_query = "SELECT * FROM tbl_movie WHERE movie_id=".$_GET['item_id']."";
	 $result = mysqli_query($dbConn, $data_query);
	 $item = mysqli_fetch_assoc($result);

	 preg_match_all('!\d+!', $item['movie_duration'], $duration);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Movie Info</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<?php include '../include/nav.html'; ?>
 <main>
 	<fieldset>
    <legend>Edit Movie Info</legend>
    <span class="error_msg"></span>
     <form action="edit_products.inc.php" method="post" enctype="multipart/form-data">
     	<div class="poster-div">
     		<input type="hidden" name="prdct_id" value="<?php echo($item['movie_id']); ?>">
     		<label for="product name" class="form-lbl">Product name:</label>
		    <p class="input-box">		      
		      <input type="text" id="prdct_name" name="name" value="<?php echo($item['movie_name']); ?>" class="form-elmt">
		    </p>
	     	<label for="email" class="form-lbl">Product image:</label>
	     	<p>		     
		      <img src="../movie_posters/<?php echo($item['movie_poster']); ?>" class="prdct_img">
		      <input type="hidden" name="old_img" value="<?php echo($item['movie_poster']); ?>"><hr>
		      <input type="file" id="poster" name="new_img">
		    </p>
		    
     	</div>
	    
	    <div class="right-div">
	    	<label for="product description" class="form-lbl">Product description:</label>
	    	<p class="input-box" >		      
		      <textarea name="desc" rows="5" cols="70" class="form-elmt"><?php echo($item['movie_desc']); ?></textarea>
		    </p>
		    <label for="trailer" class="form-lbl">Movie trialer:</label><br>
		    <p class="input-box">		     
		      <input type="url" name="link" class="form-elmt" value="<?php echo($item['movie_trialer']); ?>">
		    </p>
	    	<label for="duration" class="form-lbl">Movie duaration:</label>
	    	<p>	     
		      <select name="duration_hr">
				<?php 
			     for ($i=0; $i <= 12 ; $i++) { 
			     	if ($i === intval($duration[0][0])) {
			     		echo "<option value=".$i." selected>";
			     		 
			     		 if ($i <= 9) {
			     		 	echo "0".$i;
			     		 }else{
			     		 	echo $i;
			     		 }
			     		 
			     		echo "</option>";
			     	} else {
			     		echo "<option value=".$i.">";
			     		 
			     		 if ($i <= 9) {
			     		 	echo "0".$i;
			     		 }else{
			     		 	echo $i;
			     		 }
			     		 
			     		echo "</option>";
			     	}
			     	
			     }
				?>
			  </select><label>Hours</label>
	 	      <select name="duration_mn">
				<?php 
			     for ($i=0; $i <= 59 ; $i++) { 
			     	if ($i === intval($duration[0][1])) {
			     		echo "<option value=".$i." selected>";
			     		 
			     		 if ($i <= 9) {
			     		 	echo "0".$i;
			     		 }else{
			     		 	echo $i;
			     		 }
			     		 
			     		echo "</option>";
			     	} else {
			     		echo "<option value=".$i.">";
			     		 
			     		 if ($i <= 9) {
			     		 	echo "0".$i;
			     		 }else{
			     		 	echo $i;
			     		 }
			     		 
			     		echo "</option>";
			     	}			     	
			     }
				?>
			  </select><label>Minutes</label>		       
		    </p>
		    <label for="duration" class="form-lbl">Movie releaase date:</label>
		    <p>		     
		      <input type="date" name="release_date" value="<?php echo($item['release_date']); ?>">
		    </p>
		    <label for="duration" class="form-lbl">Movie languages :</label>
		    <p>
		      <?php 
               $radio_arr = array("English", "Hindi", "Kannada", "Tamil", "Telugu", "Marathi");

               for ($radio=0; $radio < count($radio_arr); $radio++) { 
               	if ($radio_arr[$radio] === $item['movie_language']) {
               		echo "<input type='radio' name='language[]' value='".$radio_arr[$radio]."' checked>".$radio_arr[$radio];
               	} else {
               		echo "<input type='radio' name='language[]' value='".$radio_arr[$radio]."'>".$radio_arr[$radio];
               	}
               	
               }
		      ?>
		    </p>
		    <label for="duration" class="form-lbl">Movie category:</label>
		    <p>
		      <?php 
               $chkbx_arr = array("Action", "Comedy", "Si-fi", "Horror", "Romantic", "Thriller", "Drama");
               $item = explode(", ", $item['movie_category']);
               $math_arr = array_intersect($chkbx_arr, $item);

               for ($chkbx=0; $chkbx < count($chkbx_arr); $chkbx++) { 
               	if (in_array($chkbx_arr[$chkbx], $math_arr)) {
		         echo "<input type='checkbox' name='category[]' value='".$chkbx_arr[$chkbx]."' checked>".$chkbx_arr[$chkbx];               		
               	} else {
               	 echo "<input type='checkbox' name='category[]' value='".$chkbx_arr[$chkbx]."' >".$chkbx_arr[$chkbx];
               	}
               	
               }
		      ?>
		    </p> 
	    </div>	    	    
	    
	    <input type="submit" name="edit" value="Edit Product" class="btn align-left">
	 </form>
  </fieldset>
 </main>
</body>
</html> 
<?php } ?>
<script type="text/javascript" src="errors.js"></script>