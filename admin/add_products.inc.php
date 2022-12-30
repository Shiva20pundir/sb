<?php
require_once '../config/dbConfig.php';

 $movie_name = mysqli_real_escape_string($dbConn, $_POST['name']);
 $movie_trialer = mysqli_real_escape_string($dbConn, $_POST['link']); 
 $movie_desc = mysqli_real_escape_string($dbConn, $_POST['desc']); 
 $movie_rel_date = mysqli_real_escape_string($dbConn, $_POST['release_date']); 
 
 $duration_hr = mysqli_real_escape_string($dbConn, $_POST['duration_hr']);
 $duration_mn = mysqli_real_escape_string($dbConn, $_POST['duration_mn']);
 
 $duration_str = $duration_hr."h".$duration_mn."min";

 $data_query = "SELECT movie_name FROM tbl_movie WHERE movie_name = '".$movie_name."'";
 $result = mysqli_query($dbConn, $data_query);
 $get_productData = mysqli_fetch_assoc($result);

 $query = "SELECT movie_trialer FROM tbl_movie WHERE movie_trialer = '".$movie_trialer."'";
 $query_result = mysqli_query($dbConn, $query);
 $link_data = mysqli_fetch_assoc($query_result);
 
 $prdct_img_ext = pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
 $prdct_img_newName = uniqid('', true).".".$prdct_img_ext;
 $prdct_img_dir = '../movie_posters/'.$prdct_img_newName;
 $allowed_img_type = array('jpg', 'jpeg', 'png', 'gif');

     if (empty($movie_name)||empty($movie_trialer)||empty($movie_desc)||empty($movie_rel_date)||empty($_POST['language'])||empty($_POST['category'])) {
        $inputs = array("name"=> $_POST['name'],
                        "link"=>$_POST['link'],
                        "desc"=>$_POST['desc'],
                        "release_date"=>$_POST['release_date'],
                        "poster"=>$_FILES['poster']['name'],
                        "language"=>$_POST['language'],
                        "category"=>$_POST['category']);
        $emptyInputFields = [];
       
            foreach ($inputs as $key => $value) {
                if (empty($value)) {
                  array_push($emptyInputFields, $key);
                }
            }        

        header('location: add_products.php?error=emptyInputfields&invalidInputs='.implode("+", $emptyInputFields));
     }elseif (in_array($prdct_img_ext, $allowed_img_type) === false) {
        header('location: add_products.php?error=invalidImgType&invalidInputs=poster');
     }elseif ($_FILES['img']['size'] >= 20000000) {
        header('location: add_products.php?error=largeImgFile&invalidInputs=poster');        
     }elseif ($get_productData['movie_name']) {
        header('location: add_products.php?error=prdctInUse&invalidInputs=name');
     }elseif ($movie_trialer === $link_data['movie_trialer']) {
        header('location: add_products.php?error=linkInUse&invalidInputs=link');
     }
     elseif (move_uploaded_file($_FILES['poster']['tmp_name'], $prdct_img_dir)){
          $category_arr = [];
          $lang_arr = [];
          if (!empty($_POST['category'])) {                

            foreach ($_POST['category'] as $key) {
                array_push($category_arr, mysqli_real_escape_string($dbConn, $key));
            }
          }
          if (!empty($_POST['language'])) {               

            foreach ($_POST['language'] as $key) {
                array_push($lang_arr, mysqli_real_escape_string($dbConn, $key));
            }
          }


          $create_query = "INSERT INTO\n
                           tbl_movie(movie_name, movie_poster, movie_desc, release_date, movie_trialer, movie_duration, movie_language, movie_category)\n
                           VALUES ('".$movie_name."', '".$prdct_img_newName."', '".$movie_desc."', '".$movie_rel_date."', '".$movie_trialer."', '".$duration_str."', '".implode(",", $lang_arr)."', '".implode(", ", $category_arr)."')";
          $success = mysqli_query($dbConn, $create_query);

            if (!$success) {
                 echo "Something went wrong.".mysqli_error();
                 header('location: add_products.php?error=unknown');
            } else {
                 header('location: add_products.php');
            }
     }