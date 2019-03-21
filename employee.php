<html>
<head>
<title>Home</title>
<link rel="icon" href="./images/icon.png">
<link href='./CSS/emp_main.css' rel='stylesheet' type='text/css'></link>
<link href='./menu.css' rel='stylesheet' type='text/css'></link>
</head>
<body>
<?php
  include('session.php');
	$user="Saurav";
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
	<div id="content">
          <img src="images/praise.jpg" alt="Company's Logo" style="width:100%;height:100%;opacity: 0.5">
          
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
    <h1 style="font-family: helvetica;font-size: 20;text-decoration:none;color:white;padding-left: 20px;position: relative;top:-70px;left:200px">HELLO<br> <?php echo $user ?></h1>
  </div>
  <div id="menu_option">
    <a href="employee.php" style="position: relative;top:-10px;">INFORMATION</a><br>
    <a href="manage_ingredients.php" style="position: relative;top:10px;">MANAGE INGREDIENTS</a><br>
    <a href="./manage_order.php" style="position: relative;top:30px;">MANAGE ORDER</a><br>
    <a href="./order_logs.php" style="position: relative;top:50px;">ORDER LOGS</a><br>
    <a href="process_order.php" style="position: relative;top:70px;">PROCESS ORDERS</a><br>
    <a href="manage_account.php" style="position: relative;top:90px;">MANAGE ACCOUNT</a><br>
  </div>
  <div id="checkout">
    <a href="./logout.php" style="position: relative;top:-30px;left: -10px"><img src="images/logout.png" alt="Company's Logo" style="width:80px;height:60px;position: relative;">SIGN-OUT</a>
  </div>
</div>


</body>
</html>


