<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: emp_login.php");
   }
?>