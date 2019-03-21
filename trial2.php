<?php
  if(isset($_POST["submit"])){
    die($_POST["submit"]);
  }
?>

<form method="post" action="./trial2.php">
      <input type="submit" name="submit" value="Processed">
</form>