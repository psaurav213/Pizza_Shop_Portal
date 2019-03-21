<?php
	include("config.php");
   session_start();
   if(!isset($_SESSION['login_user'])){
      header("location:emp_login.php");
   }
   else{
   		$user_check = $_SESSION['login_user'];
   }
   
?>