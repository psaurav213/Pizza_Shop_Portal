<html>
<head>
<link href='./CSS/newCust.css' rel='stylesheet' type='text/css'></link>
<link href='./feedback.css' rel='stylesheet' type='text/css'></link>
<style>

</style>
</head>
<body>
	<?php
		session_start();
		include("config.php");
		if(isset($_POST['submit'])){
			$nm=$_POST['name'];
			$hno=$_POST['hno'];
			$street=$_POST['street'];
			$city=strtolower($_POST['city']);
			$ph=$_POST['phone'];
			setcookie("phone", $_POST["phone"], time() + (60 * 30), "/");
			$email=$_POST['email'];
			$regP="/[0-9]{10}$/";
			if(empty($nm) || empty($hno) || empty($street) || empty($city) || empty($ph) || empty($email)){
				myAlert("All Fields are required");
			}
			else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				myAlert("Invalid email");
			}
			else if(!preg_match($regP,$ph)){
				myAlert("Enter valid phone number");
			}
			else if(strcmp($city,"vellore")!=0){
				myAlert("Sorry, We do not provide service in your area.");
			}
			else{
				$sql="INSERT into customer(name,streetname,city) values('$nm','$street','$city');";
				if(mysqli_query($con,$sql)){}
				else{
					myAlert("Please Try Again!");
				}
				$sql="SELECT max(cust_id) from customer";
				$us=mysqli_fetch_row(mysqli_query($con,$sql));
				$sql="INSERT into cust_phone values('$ph','$us[0]');";
				if(mysqli_query($con,$sql)){}
				else{
					myAlert("Phone Number already exists!");
				}
				$sql="INSERT into cust_mail values('$email','$us[0]');";
				if(mysqli_query($con,$sql)){}
				else{
					myAlert("Email already exists!");
				}
				$sql="INSERT into house values('$us[0]','$hno');";
				if(mysqli_query($con,$sql)){}
				else{
					myAlert("House no. could not be added!");
				}
				$_SESSION['success']=1;
				header("location:review_order.php");
			}
		}
	?>
	<div id="container" style="height: 800px;overflow: hidden" >
	<header>
		<div id='nav'>
			<img src="images/logo.png" alt="Company's Logo" style="width:100px;height:95px; position: relative; left:-1300px;padding-top: 2px">
			<h1 style="font-style: italic;font-size:30;position: relative;top:-80px;left:200px">Tim & Doug's Icecreams</h1>
			<a href='./home.php'>Home</a>
			<a href='./manage_ingredients.php'>Employee</a>
			<a href='./menu.php'>Menu</a>
			<a href='./order.php'>Order</a>
			<a href='./feedback.php'>Feedback</a>
			<a href='./about.php'>About Us</a>
		</div>
	</header>
</body>
<h1 style="position: relative;top:100px;color: black">NEW CUSTOMER FORM</h1><br>
<form method="post" action="newCust.php" style="zoom:200%;position: relative;top:50px;left:100px">
<div id="tab1">
	<div id="tab2">
		Pizza Hut
	</div>
	<div id="tab3">
		Name:
	</div>
	<div id="tab4">
	<input typt="text" name="name" size="50">
	</div>
	<div id="tab5">
		Address:
	</div>
	<div id="tab6">
		House No. <input typt="text" name="hno" size="10">
		Street Name <input typt="text" name="street" size="15"><br><br>
		City <input typt="text" name="city" size="20">
	</div>
	<div id="tab7">
		Phone Number:
	</div>
	<div id="tab8">
		<input typt="text" name="phone" size="15">
	</div>
	<div id="tab9">
		Email
	</div>
	<div id="tab10">
		<input typt="text" name="email" size="30">
	</div>

<input type="submit" name="submit" value="" style="position: relative;top:5px;left: 440px;background-image: url('./images/register.png');background-size:100% 100%;height: 50px;width: 50px;background-color: white">
</div>
</form>
</html>




