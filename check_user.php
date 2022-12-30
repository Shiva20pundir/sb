<?php
session_start();
 if (!isset($_SESSION['active_user'])) {
 	header('location: user_login.html');
 }
?>