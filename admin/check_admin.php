<?php
session_start();
 if (!isset($_SESSION['active_admin'])) {
 	header('location: user_login.html');
 }
?>