<?php
if (isset($_POST['login'])) {
	require_once 'config/dbConfig.php';
	session_start();

	$user_email = mysqli_real_escape_string($dbConn, $_POST['email']);
	$user_pass = mysqli_real_escape_string($dbConn, $_POST['password']);

	$query = "SELECT user_email, user_password FROM tbl_user WHERE user_email = '".$user_email."'";
	$result = mysqli_query($dbConn, $query);
	$getData = mysqli_fetch_assoc($result);

	if (empty($user_email)||empty($user_pass)) {
        $emptyInputFields = [];
        foreach ($_POST as $inputFeild => $value) {
                  if (empty($value)) {
                    
                       array_push($emptyInputFields, $inputFeild);
                  }
               }

        header('location: user_login.html?error=emptyInputfields&invalidInputs='.implode("+", $emptyInputFields));
    }elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        header('location: user_login.html?error=invalidEmail&invalidInputs=email');
    }elseif (!$getData['user_email']) {
        header('location: user_login.html?error=invalidUser&invalidInputs=email');
    }elseif (!password_verify($user_pass, $getData['user_password'])) {
    	header('location: user_login.html?error=incorrectPassword&invalidInputs=pwd');
    }else{
    	$_SESSION['active_user'] = $getData['user_email'];
    	header('location: index.php');
    }
}