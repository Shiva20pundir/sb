<?php
require_once '../config/dbConfig.php';

 $movie_id = mysqli_real_escape_string($dbConn, $_POST['prdct_id']);
 $movie_name = mysqli_real_escape_string($dbConn, $_POST['name']);
 $movie_trialer = mysqli_real_escape_string($dbConn, $_POST['link']); 
 $movie_desc = mysqli_real_escape_string($dbConn, $_POST['desc']); 
 $movie_rel_date = mysqli_real_escape_string($dbConn, $_POST['release_date']);
 $old_img = mysqli_real_escape_string($dbConn, $_POST['old_img']);
 
 $duration_hr = mysqli_real_escape_string($dbConn, $_POST['duration_hr']);
 $duration_mn = mysqli_real_escape_string($dbConn, $_POST['duration_mn']);
 
 $duration_str = $duration_hr."h".$duration_mn."min";

 $category_arr = [];
 $lang_arr = [];

 foreach ($_POST['category'] as $category) {
   array_push($category_arr, mysqli_real_escape_string($dbConn, $category));
 }

 foreach ($_POST['language'] as $language) {   
   array_push($lang_arr, mysqli_real_escape_string($dbConn, $language));
 }
 
  if (empty($movie_name)||empty($movie_desc)) {
  	$inputs = array($movie_name, $movie_desc);
    $emptyInputFields = [];       
        
        foreach ($inputs as $key => $value) {
            if (empty($value)) {                  
              array_push($emptyInputFields, $inputFeild);
            }
        }
                
  	header('location: edit_products.php?item_id='.$movie_id.'&error=emptyInputfields&invalidInputs='.implode("+", $emptyInputFields));
  } elseif (empty($_FILES['new_img']['name'])) {	

  	$update_query = "UPDATE tbl_movie SET movie_name='".$movie_name."',movie_desc='".$movie_desc."',\n
                                          movie_poster='".$old_img."', movie_trialer='".$movie_trialer."',\n
                                          release_date='".$movie_rel_date."', movie_duration='".$duration_str."',\n
                                          movie_language='".implode("", $lang_arr)."', movie_category='".implode(", ", $category_arr)."'\n
                                          WHERE movie_id =".$movie_id;
    $success = mysqli_query($dbConn, $update_query);

        if (!$success) {
             echo "Something went wrong.".mysqli_error();
             header('location: edit_products.php?item_id='.$movie_id.'&error=unknown');
        } else {
             header('location: edit_products.php?item_id='.$movie_id.'');
        }
  }else{
  $prdct_img_ext = pathinfo($_FILES['new_img']['name'], PATHINFO_EXTENSION);
	$prdct_img_newName = uniqid('', true).".".$prdct_img_ext;
	$prdct_img_dir = '../movie_posters/'.$prdct_img_newName;
	$allowed_img_type = array('jpg', 'jpeg', 'png', 'gif');

  	if (in_array($prdct_img_ext, $allowed_img_type) === false) {
       header('location: edit_products.php?item_id='.$movie_id.'&error=invalidImgType&invalidInputs=img');
    }elseif ($_FILES['new_img']['size'] >= 20000000) {
       header('location: edit_products.php?item_id='.$movie_id.'&error=largeImgFile&invalidInputs=img');        
    }
    elseif (move_uploaded_file($_FILES['new_img']['tmp_name'], $prdct_img_dir)){
       unlink('upload/'.$old_img);
       $update_query = "UPDATE tbl_movie SET movie_name='".$movie_name."',movie_desc='".$movie_desc."',\n
                                             movie_poster='".$prdct_img_newName."', movie_trialer='".$movie_trialer."',\n
                                             release_date='".$movie_rel_date."', movie_duration='".$duration_str."',\n
                                             movie_language='".implode("", $lang_arr)."', movie_category='".implode(", ", $category_arr)."'\n
                                             WHERE movie_id =".$movie_id;
       $success = mysqli_query($dbConn, $update_query);

          if (!$success) {
           echo "Something went wrong.".mysqli_error();
           header('location: edit_products.php?item_id='.$movie_id.'&error=unknown');
          } else {
               header('location: product_list.php');
          }
    }
  }
  