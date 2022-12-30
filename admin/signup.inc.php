<?php
if (isset($_POST['register'])) {
     require_once 'config/dbConfig.php';
	     
     $user_fname = mysqli_real_escape_string($dbConn, $_POST['fname']);
     $user_lname = mysqli_real_escape_string($dbConn, $_POST['lname']);
     $user_email = mysqli_real_escape_string($dbConn, $_POST['email']);
     $userPassword = mysqli_real_escape_string($dbConn, $_POST['pwd']);
     $user_conf_pwd = mysqli_real_escape_string($dbConn, $_POST['conf_pwd']);
     $hashPass = password_hash($userPassword, PASSWORD_BCRYPT);     

     $data_query = "SELECT user_email FROM tbl_user WHERE user_email = '".$user_email."'";
     $result = mysqli_query($dbConn, $data_query);
     $getEmail = mysqli_fetch_assoc($result);

     if (empty($user_fname)||empty($user_lname)||empty($user_email)||empty($userPassword)||empty($user_conf_pwd)) {
        $emptyInputFields = [];
        foreach ($_POST as $inputFeild => $value) {
                  if (empty($value)) {
                    
                       array_push($emptyInputFields, $inputFeild);
                  }
               }

        header('location: user_signup.html?error=emptyInputfields&invalidInputs='.implode("+", $emptyInputFields));
     }elseif (strlen($user_fname) < 3 || strlen($user_fname) >= 30 || strlen($user_lname) < 3 || strlen($user_lname) >= 30) {

          $userName = array("fname"=>$user_fname, "lname"=>$user_lname);
          $invalidInpt = array();

          foreach ($userName as $inpt => $inptValue) {
               
             if (strlen($inptValue) <= 3) {
                  array_push($invalidInpt, $inpt);
                 
             }elseif (strlen($inptValue) >= 30) {
                 array_push($invalidInpt, $inpt);
                 
             }
          }
          header('location: user_signup.html?error=invalidInputLength&invalidInputs='.implode("+", $invalidInpt));

     }elseif (!preg_match('/^[a-zA-Z]+$/', $user_fname)||!preg_match('/^[a-zA-Z]+$/', $user_lname)) {
          $user_name = array("fname"=>$user_fname, "lname"=>$user_lname);
          $invalid_inputs_arr = [];

          foreach ($user_name as $name=>$value2) {
               if(!preg_match('/^[a-zA-Z]+$/', $value2)){
                    array_push($invalid_inputs_arr, $name);
               }
          }

          header('location: user_signup.html?error=invalidInput&invalidInputs='.implode("+", $invalid_inputs_arr));
         
     }elseif(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
          header('location: user_signup.html?error=invalidEmail&invalidInputs=email');
     }elseif ($getEmail['user_email']) {
          header('location: user_signup.html?error=registerdEmail&invalidInputs=email');
     }elseif (strlen($userPassword) <= 7 || strlen($userPassword) >= 30) {
          if(strlen($userPassword) <= 7){
               header('location: user_signup.html?error=weakPass&invalidInputs=pwd');
          }elseif (strlen($user_password) >= 30) {
               header('location: user_signup.html?error=invalidInputLength&invalidInputs=pwd');
          }
     }elseif ($userPassword !== $user_conf_pwd) {
          header('location: user_signup.html?error=distinctPass&invalidInputs=conf_pwd');
     }
     else{
          $register_query = "INSERT INTO tbl_admin(admin_name, admin_email, admin_password)\n
                             VALUES('".ucfirst($user_fname)." ".ucfirst($user_lname)."', '".$user_email."','".$hashPass."')";
          $register = mysqli_query($dbConn, $register_query);

            if (!$register) {
                 echo "Something went wrong.".mysqli_error();
                 header('location: user_signup.html?error=unknown');
            } else {
                 header('location: user_login.html');
            }
     }
}
