<?php
  $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = '';
      $db='pizza';
      $con = mysqli_connect($dbhost,$dbuser,$dbpass,$db);
      if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
   function nameTrim($n){
  $nm=explode(" ",$n);
  return $nm[0];
}
?>
<?php 
function myAlert($msg){
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function myConnection(){
  $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = '';
      $db='pizza';
      $con = mysqli_connect($dbhost,$dbuser,$dbpass,$db);
      if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      mysqli_select_db($con,'pizza');
  return $con;
}

?>


