<html>
<head>
<title>Home</title>
<link rel="icon" href="./images/icon.png">
<link href='./CSS/home.css' rel='stylesheet' type='text/css'></link>
</head>
<body>
	<?php
		$con=myConnection();
		$sql="SELECT F.pizza_name ,C.cost from pizza F,pizza_details C where F.flvr_id=C.flvr_id;";
		$flvr=array();
		$qr=mysqli_query($con,$sql);
		while($r=mysqli_fetch_row($qr)){
			array_push($flvr,array($r[0],$r[1]));
		}
		if(isset($_POST["submit"])){
			if(!empty($_POST["phone"])){
				$ph=$_POST["phone"];
				setcookie("phone", $_POST["phone"], time() + (60 * 30), "/");
				$arr=array("butter","choc","jak","nash","pista","siz");
				for($i=1;$i<=6;$i++){
					setcookie($arr[$i-1], $_POST["qt$i"], time() + (60 * 30), "/");
				}
				$tp=$_POST["type"];
				if(strcmp($_POST["type"],'takeaway')==0){
					setcookie("take", 1, time() + (60 * 30), "/");
					setcookie("delivery", 0, time() + (60 * 30), "/");
				}
				else{
					setcookie("delivery", 1, time() + (60 * 30), "/");
					setcookie("take", 0, time() + (60 * 30), "/");
				}
				$sql="select count(phone) from cust_phone where phone='$ph'";
				$qr=mysqli_fetch_row(mysqli_query($con,$sql));
				if($qr[0]>=1)
					header("location:review_order.php");
				else
					header("location:newCust.php");
			}
			else{
				myAlert("You must enter your phone number to continue.");
			}
		}
	?>
<div id="container" style="height: 1450px;overflow: hidden" >
	<header>
		<div id='nav'>
			<img src="images/logo.png" alt="Company's Logo" style="width:100px;height:95px; position: relative; left:-1300px;padding-top: 2px">
			<h1 style="font-style: italic;font-size:30;position: relative;top:-80px;left:200px">Pizza Hut</h1>
			<a href='./home.php'>Home</a>
			<a href='./manage_ingredients.php'>Employee</a>
			<a href='./menu.php'>Menu</a>
			<a href='./order.php'>Order</a>
			<a href='./feedback.php'>Feedback</a>
			<a href='./about.php'>About Us</a>
		</div>
	</header>
<form method="post" action="./order.php">
	<div id="menu" style="position: relative;top:200px;overflow: hidden">

		<div id="box" style="border:4px solid black;height:450px;width:350px;position: relative;left:50px">
			<div id="image">
				<img src="./images/flavours/1.jpg" style="height: 56%;width: 100%">
			</div>
			<div id="details" style="border:2px solid black;height: 44%;width: 100%;">
				<center><h1 style="position: relative;top:-10px;left: 20px"><?php echo $flvr[0][0]; ?></h1>
				<h1 style="position: relative;top:-10px;left: 110px;font-size: 20px;">RATE : <?php echo $flvr[0][1]."  $"; ?></h1>
				<h1 style="font-size: 25px;position: relative;left: 60px">QUANTITY: </h1>
					<select name="qt1" style="height: 30px;width: 50px;position: relative;left: 80px;top:-45px">
                                <?php
                                  foreach(range(0,5) as $r ) { ?>
                                          <option value="<?php echo $r ?>"> <?php echo $r;?></option>
                                        <?php
                                } ?>
                     </select>
				</center>
				</div>
		</div>

		<div id="box" style="border:4px solid black;height:450px;width:350px;position: relative;top:-460px;left:525px">
			<div id="image">
				<img src="./images/flavours/2.jpg" style="height: 56%;width: 100%">
			</div>
			<div id="details" style="border:2px solid black;height: 44%;width: 100%;">
				<center><h1 style="position: relative;top:-10px;left: 20px"><?php echo $flvr[1][0]; ?></h1>
				<h1 style="position: relative;top:-10px;left: 110px;font-size: 20px;">RATE : <?php echo $flvr[1][1]."  $"; ?></h1>
				<h1 style="font-size: 25px;position: relative;left: 40px">QUANTITY: </h1>
					<select name="qt2" style="height: 30px;width: 50px;position: relative;left: 60px;top:-45px">
                                <?php
                                  foreach(range(0,5) as $r ) { ?>
                                          <option value="<?php echo $r ?>"> <?php echo $r;?></option>
                                        <?php
                                } ?>
                     </select>
				</center>
				</div>
		</div>


		<div id="box" style="border:4px solid black;height:450px;width:350px;position: relative;top:-930px;left:1000px">
			<div id="image">
				<img src="./images/flavours/3.jpg" style="height: 56%;width: 100%">
			</div>
			<div id="details" style="border:2px solid black;height: 44%;width: 100%;">
				<h1 style="position: relative;top:-10px;left: 20px"><?php echo $flvr[2][0]; ?></h1>
				<h1 style="position: relative;top:-10px;left: 110px;font-size: 20px;">RATE : <?php echo $flvr[2][1]."  $"; ?></h1>
				<h1 style="font-size: 25px;position: relative;left: 40px">QUANTITY: </h1>
					<select name="qt3" style="height: 30px;width: 50px;position: relative;left: 60px;top:-45px">
                                <?php
                                  foreach(range(0,5) as $r ) { ?>
                                          <option value="<?php echo $r ?>"> <?php echo $r;?></option>
                                        <?php
                                } ?>
                     </select>
			</div>	
		</div>

		<div id="box" style="border:4px solid black;height:450px;width:350px;position: relative;top:-800px;left:50px">
			<div id="image">
				<img src="./images/flavours/4.jpg" style="height: 56%;width: 100%">
			</div>
			<div id="details" style="border:2px solid black;height: 44%;width: 100%;">
				<h1 style="position: relative;top:-10px;left: 20px"><?php echo $flvr[3][0]; ?></h1>
				<h1 style="position: relative;top:-10px;left: 110px;font-size: 20px;">RATE : <?php echo $flvr[3][1]."  $"; ?></h1>
				<h1 style="font-size: 25px;position: relative;left: 40px">QUANTITY: </h1>
					<select name="qt4" style="height: 30px;width: 50px;position: relative;left: 60px;top:-45px">
                                <?php
                                  foreach(range(0,5) as $r ) { ?>
                                          <option value="<?php echo $r ?>"> <?php echo $r;?></option>
                                        <?php
                                } ?>
                     </select>
			</div>	
		</div>

		<div id="box" style="border:4px solid black;height:450px;width:350px;position: relative;top:-1260px;left:525px">
			<div id="image">
				<img src="./images/flavours/5.jpg" style="height: 56%;width: 100%">
			</div>
			<div id="details" style="border:2px solid black;height: 44%;width: 100%;">
				<h1 style="position: relative;top:-10px;left: 20px"><?php echo $flvr[4][0]; ?></h1>
				<h1 style="position: relative;top:-10px;left: 110px;font-size: 20px;">RATE : <?php echo $flvr[4][1]."  $"; ?></h1>
				<h1 style="font-size: 25px;position: relative;left: 40px">QUANTITY: </h1>
					<select name="qt5" style="height: 30px;width: 50px;position: relative;left: 60px;top:-45px">
                                <?php
                                  foreach(range(0,5) as $r ) { ?>
                                          <option value="<?php echo $r ?>"> <?php echo $r;?></option>
                                        <?php
                                } ?>
                     </select>
			</div>	
		</div>

		<div id="box" style="border:4px solid black;height:450px;width:350px;position: relative;top:-1720px;left:1000px">
			<div id="image">
				<img src="./images/flavours/6.jpg" style="height: 56%;width: 100%">
			</div>
			<div id="details" style="border:2px solid black;height: 44%;width: 100%;">
				<h1 style="position: relative;top:-10px;left: 20px"><?php echo $flvr[5][0]; ?></h1>
				<h1 style="position: relative;top:-10px;left: 110px;font-size: 20px;">RATE : <?php echo $flvr[5][1]."  $"; ?></h1>
				<h1 style="font-size: 25px;position: relative;left: 40px">QUANTITY: </h1>
					<select name="qt6" style="height: 30px;width: 50px;position: relative;left: 60px;top:-45px">
                                <?php
                                  foreach(range(0,5) as $r ) { ?>
                                          <option value="<?php echo $r ?>"> <?php echo $r;?></option>
                                        <?php
                                } ?>
                     </select>
			</div>	
		</div>


	</div>
</div>
	
<div id="overall" style="position: fixed;top:690px;z-index: 10;background-color: grey;height: 140px;width: 100%;left:0px">
	<h1 style="color:black;font-size: 25px;position: relative;left: 40px">Enter Phone Number: </h1><input type="text" name="phone" style="height: 30px;width: 160px;position: relative;top:-110px;left: -320px">
	<input type="radio" name="type" value="takeaway" style="position: relative;top:-110px;left: -200px;" checked><img src="./images/takeaway.png" style="height: 130px;width: 160px;position: relative;top:-40px;left: -190px">
	<input type="radio" name="type" value="delivery" style="position: relative;top:-110px;left: 0px;"><img src="./images/homedel.png" style="height: 110px;width: 160px;position: relative;top:-60px;left: 20px;">
	<input type="submit" name="submit" value="" style="background-image: url('./images/ordernow.png');background-size:100% 100%;position: relative;left:300px;top:-70px;height: 110px;width: 150px;background-color: white">
</div>
</form>
</body>
</html>


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