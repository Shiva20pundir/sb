<?php include 'check_admin.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Schedule Movies</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<?php include '../include/nav.html'; ?>
<main>
	<fieldset class="">
    <legend>Schedule Movies</legend>
    
     <form action="add_products.inc.php" method="post" enctype="multipart/form-data">
	    <div class="left"><!-- 
	    	<span class="user_form__msg"></span><br> -->
	    	<label for="product name" class="form-lbl">Movie name:</label><br>
	    	<p class="input-box">		     
		      <input type="text" id="name" name="name" min="2" max="20" class="form-elmt">
		    </p>
			<label for="poster" class="form-lbl">Movie poster:</label><br>
		    <p class="input-box">		     
		      <input type="file" id="poster" name="poster" accept="image/jpeg" class="form-elmt">
		    </p>
			<label for="trailer" class="form-lbl">Movie trialer:</label><br>
		    <p class="input-box">		     
		      <input type="url" name="link" class="form-elmt">
		    </p>
		    <label for="description" class="form-lbl">Movie description:</label><br>
		    <p class="input-box">		     
		      <textarea name="desc" rows="10" cols="50" class="form-elmt"></textarea>
		    </p>
	    </div>
	    <div class="right">
	    	<label for="duration" class="form-lbl">Movie duaration:</label>
	    	<p>		     
		      <input type="text" name="duration_hr" id="hour_inpt" class="hour_inpt" list="hrs_list" size="2"><label>Hours</label>
	 	      <input type="text" name="duration_mn" id="min_inpt" class="min_inpt" list="mns_list" size="2"><label>Minutes</label>		      
		       <datalist class="movie_hour" id="hrs_list"></datalist>
		       <datalist class="movie_minute" id="mns_list"></datalist>		       
		    </p>
		    <label for="duration" class="form-lbl">Movie releaase date:</label>
		    <p>		     
		      <input type="date" name="release_date">
		    </p>
		    <label for="duration" class="form-lbl">Movie languages :</label>
		    <p>		     
		      <input type="radio" name="language[]" value="English">English
		      <input type="radio" name="language[]" value="Hindi">Hindi
		      <input type="radio" name="language[]" value="Kannada">Kannada
		      <input type="radio" name="language[]" value="Tamil">Tamil
		      <input type="radio" name="language[]" value="Telugu">Telugu
		      <input type="radio" name="language[]" value="Marathi">Marathi
		    </p>
		    <label for="duration" class="form-lbl">Movie category:</label>
		    <p>		     
		      <input type="checkbox" name="category[]" value="Action">Action
		      <input type="checkbox" name="category[]" value="Comedy">Comedy
		      <input type="checkbox" name="category[]" value="Crime">Crime 
		      <input type="checkbox" name="category[]" value="Si-fi">Si-fi
		      <input type="checkbox" name="category[]" value="Horror">Horror
		      <input type="checkbox" name="category[]" value="Romantic">Romantic
		      <input type="checkbox" name="category[]" value="Thriller">Thriller<br>
		      <input type="checkbox" name="category[]" value="Drama">Drama         
		      
		    </p>
	    </div>
	    <input type="submit" name="register" value="Add Movie" class="btn align-left">    
	 </form>
  </fieldset>
</main>
</body>
</html>
<script type="text/javascript" src="../js/errors.js"></script>
<script type="text/javascript" src="../js/script.js"></script>