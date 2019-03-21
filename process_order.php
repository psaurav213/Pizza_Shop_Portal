<?php
  include('session.php');
  $con=myConnection();
  $sql="select name from employee where emp_id=$user_check;";
  $us=mysqli_fetch_array(mysqli_query($con,$sql));
  $user=nameTrim($us["name"]);
  $gen="male";
  $a=array(32,22,31,45,1,1);
  $sql="SELECT F.pizza_name from pizza F,icecream_details C where F.flvr_id=C.flvr_id;";
  $b=[];
  $qr=mysqli_query($con,$sql);
  while($r=mysqli_fetch_row($qr)){
    array_push($b,$r[0]);
  }
  $sql ='select A.flvr_id,B.flvr_name,count(A.flvr_id)as freq from order_qty A,pizza B where A.flvr_id=B.flvr_id group by A.flvr_id order by freq DESC;';
  $ar=[];
  $qr=mysqli_query($con,$sql);
  while($r=mysqli_fetch_row($qr)){
    array_push($ar,$r[2]);
  }
  if(isset($_POST["prc"])){
    $x=(int)$_POST['prc'];
    $sql="update order_status set inlock=0 where ord_id='$x';";
    mysqli_query($con,$sql);
    header("location:process_order.php");
  }

?>
<html>
<head>
<title>Home</title>
<link rel="icon" href="./images/icon.png">
<link href='./CSS/emp_orlog.css' rel='stylesheet' type='text/css'></link>
<link href='./menu.css' rel='stylesheet' type='text/css'></link>
</head>
<body>
<div id="container" style="height: 1000px;">
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
  <img src="images/order_logs.jpg" alt="Company's Logo" style="width:100%;height:100%;opacity: 0.3">
  <div id="orders" style="position: relative;top:-800px;left: 200px">
    <h1 style="font-size:30;color:black;position: relative;top:-140px;left:00px">Unprocessed Orders:</h1>
    <?php
        $sql="SELECT ord_id from order_status where inlock=1;";
        $po=mysqli_query($con,$sql);
        $orders=[];
        while($r=mysqli_fetch_row($po)){
          array_push($orders,$r[0]);
        }
        for($i=0;$i<sizeof($orders);$i++){
          $sql="select B.flvr_id,B.qty from order_qty B where B.ord_id='$orders[$i]';";
          $retval = mysqli_query($con,$sql);
          $od_det=[];
          while($r=mysqli_fetch_row($retval)){
            $od_det[$r[0]]=$r[1];
          } ?>
          <div>
            <h1 style="font-size:20;color:black;position: relative;top:-80px;left:00px">Order ID: <?php echo $orders[$i];?></h1>
            <table style="position: relative;top:-70px">
              <tr><th>Flavour Id</th><th>Quantity</th></tr>
              <?php
                  foreach($od_det as $key=>$val){
                    echo "<tr><th>$key</th><th>$val</th></tr>";
                  }
              ?>
            </table>
            
          <form method="post" action="process_order.php" style="position: relative;top:-100px;left:-300px">
                  <input type="submit" name="prc" value="<?php echo $orders[$i];?>">
            </form>
        </div>
        <?php 
          $sql="SELECT type from ord_type where ord_id='$orders[$i]';";
          $po=mysqli_fetch_row(mysqli_query($con,$sql));
          if(strcmp($po[0],"takeaway")==0){
            $off=0;
          }
          else{
              $sql="SELECT H.hno,C.streetname,C.city from house H,customer C where C.cust_id=(SELECT P.cust_id from cust_phone P where P.phone=(select D.phone from ord_num D where D.ord_id='$orders[$i]')) limit 1";
              $po=mysqli_fetch_row(mysqli_query($con,$sql));
              $off=1;
          }?>
          <div style="position: relative;top:-200px;left: 150px">
              <?php
                if($off==0)
                  echo "Take-away Order.";
                else
                  echo "Home Delivery @ House no. $po[0], $po[1], $po[2]";
              ?>
          </div>
      <?php }
    ?>
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


