<?php
  include('session.php');
  $con=myConnection();
  $sql="select email from mailing;";
  $us=mysqli_query($con,$sql);
  $ar=[];
  while($r=mysqli_fetch_row($us)){
    array_push($ar,$r[0]);
  }
  if(isset($_POST['send'])){
    $p=0;
    foreach($ar as $a){
      $to = $a;
      $subject = $_POST["subject"];
      $message = $_POST["message"]; 
      $from = 'PizzaHut@gmail.com';
      if(mail($to, $subject, $message)){ $p=0;}
      else{ $p=1; break;}
    }
    if($p==1)
        myAlert("There was a connection problem");
      else
        myAlert("All mails sent successfully sent");
  }
  $sql="select name from employee where emp_id=$user_check;";
  $us=mysqli_fetch_array(mysqli_query($con,$sql));
  $user=nameTrim($us["name"]);
  $gen="male";
?>
<html>
<head>
<title>Home</title>
<link rel="icon" href="./images/icon.png">
<link href='./CSS/newCust.css' rel='stylesheet' type='text/css'></link>
<link href='./CSS/emp_orlog.css' rel='stylesheet' type='text/css'></link>
<link href='./menu.css' rel='stylesheet' type='text/css'></link>
</head>
<body style="overflow: hidden;">

<div id="container" style="height: 1000px;overflow: hidden">
	<header>
		<div id='nav'>
			<img src="images/logo.png" alt="Company's Logo" style="width:100px;height:95px; position: relative; left:-1300px;padding-top: 2px">
			<h1 style="font-style: italic;font-size:30;position: relative;top:-80px;left:200px">Tim & Doug's Icecreams</h1>
			<a href='./home.php'>Home</a>
      <a href='./employee.php'>Employee</a>
      <a href='./menu.php'>Menu</a>
      <a href='./order.php'>Order</a>
      <a href='./feedback.php'>Feedback</a>
      <a href='./about.php'>About Us</a>
		</div>
	</header>
  <div id="mailForm" style="position: relative;top:60px;left: 60px;zoom:200%">
    <form method="post" action="sendMail.php">
      <div id="tab1">
        <div id="tab2">
          Mailing List Mail
        </div>
        <div id="tab3">
          Subject:
        </div>
        <div id="tab4">
          <input type="text" name="subject" size="50">
        </div>
        <div id="tab5" style="height: 120px">
          Body:
        </div>
        <div id="tab6" style="height: 120px">
            <textarea name="message"  style="height: 120px;width: 300px">Enter text here...</textarea>
        </div>
      </div>
      <input type="submit" name="send" value="" style="position: relative;top:-80px;left: 150px;background-image: url('./images/register.png');background-size:100% 100%;height: 50px;width: 50px;background-color: white">
    </form>
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
    <h1 style="font-family: helvetica;font-size: 20;text-decoration:none;color:white;padding-left: 20px;position: relative;top:-70px;left:200px">HELLO<br> <?php echo $user ?></h1>
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


