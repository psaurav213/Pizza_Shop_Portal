<html>
<head>
<title>Home</title>
<link rel="icon" href="./images/icon.png">
<link href='./CSS/emp_ing.css' rel='stylesheet' type='text/css'></link>
<link href='./menu.css' rel='stylesheet' type='text/css'></link>
</head>
<body>
<?php
  include('session.php');
  $con=myConnection();
  $sql="select name from employee where emp_id=$user_check;";
	$us=mysqli_fetch_array(mysqli_query($con,$sql));
  $user=nameTrim($us["name"]);
	$gen="male";
?>
<div id="container">
	<header>
		<div id='nav'>
			<img src="images/logo.png" alt="Company's Logo" style="width:100px;height:95px; position: relative; left:-1300px;padding-top: 2px">
			<h1 style="font-style: italic;font-size:30;position: relative;top:-80px;left:200px">Pizza Hut</h1>
			<a href='./home.php'>Home</a>
      <a href='./employee.php'>Employee</a>
      <a href='./menu.php'>Menu</a>
      <a href='./order.php'>Order</a>
      <a href='./feedback.php'>Feedback</a>
      <a href='./about.php'>About Us</a>
		</div>
	</header>
  <img src="images/ingredients.jpg" alt="Company's Logo" style="width:100%;height:100%;opacity: 0.4">
	<div id="content" style="position: fixed;top:100px;left: 500px;">
  <div id="stock">
      <strong><h1 style="color: #FF5733"><p style='font-size:50'><?php echo "Stock:" ?></h1></strong>
      <?php
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $db='pizza';
        $con = mysqli_connect($dbhost,$dbuser,$dbpass,$db);
        if (mysqli_connect_errno()){
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $sql ='select I.pid,I.pname,ID.stock from ingredient I,ingredient_detail ID where I.pid=ID.pid';
        mysqli_select_db($con,'pizza');
        $retval = mysqli_query($con,$sql);
        if(! $retval ) {
          die('Could not get data: ' . mysqli_error($con));
        }
        mysqli_close($con);
      ?>
    <table class="table" style="position: relative;top:-20px">
      <tr>
      <th><a>ID</a></th>
      <th><a>Name</a></th>
      <th><a>Stock</a></th>
      </tr>
        <?php
            if(mysqli_num_rows($retval)>0){
                while($row=mysqli_fetch_array($retval)){
        ?>
					<tr>
					<td><b><?php echo $row['pid']; ?></b></td> 
					<td><b><?php echo $row['pname']; ?></b></td> 
					<td><b><?php echo $row['stock']; ?></b></td> 
					</tr>
				<?php }
			}
		?>
   </table>
  </div>
  <div id="update" style="">
    <strong><h3 style="color:#FF5733"><div align =left><p style='font-size:50'><?php echo"Update Stock:"; ?></div></h3></strong> 
    <?php
         if(isset($_POST['update'])) {
          if(empty($_POST["stock"])){
              myAlert("Quantity must be entered");
            }
            else{
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $db='pizza';
            $con = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
            
            if(! $con ) {
               die('Could not connect: ' . mysqli_error($con));
            }
            $pid = $_POST['pid'];
            $sql = "select stock from ingredient_detail where pid='$pid'";
            $st = mysqli_fetch_row(mysqli_query($con,$sql ));
            echo $st[0];
            $stock = $_POST['stock'] + $st[0];
            mysqli_select_db($con,'parlour');
            $sql = "update ingredient_detail set stock='$stock' where pid='$pid'";
            $retval = mysqli_query($con,$sql );
            
            if(! $retval ) {
               die('Could not update data: ' . mysqli_error($con));
            }
      
            echo "Updated data successfully\n";
            header('Location: '.$_SERVER['PHP_SELF']);
            die;
            mysqli_close($con);
          }
     }
    ?>
               <form method = "post" action = "<?php $_PHP_SELF ?>">
                  <div id="stock_drop" style="position: relative;top:-25px;left: -90px">
                  <?php
                    $dbhost = 'localhost';
                    $dbuser = 'root';
                    $dbpass = '';
                    $db='pizza';
                    $con = mysqli_connect($dbhost,$dbuser,$dbpass,$db);
                    if (mysqli_connect_errno()){
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $sql ='select pid from ingredient;';
                    mysqli_select_db($con,'parlour');
                    $retval = mysqli_query($con,$sql);
                    if(! $retval ) {
                      die('Could not get data: ' . mysqli_error($con));
                    }
                    mysqli_close($con);
                    echo "<a style='position: relative;left:-30px'>Ingredients:</a> <select name='pid'  style='position: relative;top:-5px'>";
                    If(mysqli_num_rows($retval)>0){
                      while($row=mysqli_fetch_array($retval)){  
                        ?> <option value='<?php echo $row['pid']; ?>'> <?php echo $row['pid']; ?></option> <?php }
                    echo "</select>";
                    ?><?php }
                  ?><br>
                  <a style="position: relative;left: 70px">Add Quantity: <input type="integer" name="stock" style="width:30px;position: relative;top:-5px;left: 10px;padding-left: 5px"></a>
                  <input type="submit" name="update" value="" style="height: 60;width:200px;position: relative;left:200px;background-image: url('./images/update.png');background-size:100% 100%">
                  </div>
               </form>
            <?php
      ?>
    </div>

</div>
    
</div>
	
<div id="menu" style="position: fixed;top:100px">
  <div id="avatar">
    <?php
    if($gen=="male"){
      echo "<img src='images/avatar.jpg' alt='Company's Logo' style='width:80px;height:80px;position: relative;padding-left:0px;'>";
    }
    else{
      echo "<img src='images/avatar_girl.jpg' alt='Company's Logo' style='width:80px;height:80px;position: relative;padding-left:0px;'>";
    }
    ?>
    <h1 style="font-family: helvetica;font-size: 20;text-decoration:none;color:white;padding-left: 20px;position: relative;top:-70px;left:200px">HELLO<br> <?php echo $user; ?></h1>
  </div>
  <div id="menu_option">
    <a href="manage_ingredients.php" style="position: relative;top:10px;">MANAGE INGREDIENTS</a><br>
    <a href="manage_account.php" style="position: relative;top:30px;">MANAGE ACCOUNT</a><br>
    <a href="process_order.php" style="position: relative;top:50px;">PROCESS ORDERS</a><br>
    <a href="./order_logs.php" style="position: relative;top:70px;">ORDER LOGS</a><br>
    <a href="./sendMail.php" style="position: relative;top:90px;">MAILING</a><br>
    <a href="./leave.php" style="position: relative;top:140px;">LEAVE REQUEST</a><br>
  </div>
  <div id="checkout">
    <a href="./logout.php" style="position: relative;top:-30px;left: -10px"><img src="images/logout.png" alt="Company's Logo" style="width:80px;height:60px;position: relative;">SIGN-OUT</a>
  </div>
</div>


</body>
</html>