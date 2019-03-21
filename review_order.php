<html>
<head>
<title>Home</title>
<link rel="icon" href="./images/icon.png">
<link href='./CSS/home.css' rel='stylesheet' type='text/css'></link>
</head>
<body >
	<?php
		session_start();
		$con=myConnection();
		$phone=$ph=$_COOKIE["phone"];
		$sql="SELECT C.cust_id from customer C where C.cust_id =(SELECT A.cust_id from cust_phone A where A.phone='$ph');";
		$us=mysqli_fetch_row(mysqli_query($con,$sql));
		$sql="SELECT C.name,C.streetname,C.city from customer C where C.cust_id =(SELECT A.cust_id from cust_phone A where A.phone='$ph');";
		$rs=mysqli_fetch_row(mysqli_query($con,$sql));
		$arr=array("Margherita","Double-Cheese-Margherita","Farm-House","Peppy-Paneer","Mexican-Green Wave","Delux-Vegie");
		$sql="SELECT F.flvr_name ,C.cost,F.flvr_id from Pizza F,Pizza_details C where F.flvr_id=C.flvr_id;";
		$flvr=[];
		$qr=mysqli_query($con,$sql);
		while($r=mysqli_fetch_row($qr)){
			array_push($flvr,array($r[0],$r[1],$r[2]));
		}
		$sql="SELECT D.hno from house D where cust_id=(SELECT cust_id from customer C where C.cust_id =(SELECT A.cust_id from cust_phone A where A.phone='$ph'));";
		$qr=mysqli_fetch_row(mysqli_query($con,$sql));
		if(isset($_POST['update'])){
			$hn=$_POST['hno'];
			$st=$_POST['street'];
			$ct=$_POST['city'];
			if(empty($hn) || empty($st) || empty($ct)){
				myAlert("All fields are required.");
			}
			else{
				$sql="UPDATE customer set streetname='$st',city='$ct' where cust_id='$us[0]';";
				if(!mysqli_query($con,$sql)){
					echo mysqli_error($con);die;
				}
				else{
					header("location:./review_order.php");
				}
			}
		}
		if(isset($_POST['confirm'])){
			$date=date('Y-m-d');
			$sql = "insert into order_details (dt_ord)values('$date');";
			mysqli_query($con,$sql); 
			$sql="SELECT max(ord_id) from order_details;";
			$ordId=mysqli_fetch_row(mysqli_query($con,$sql));
			$sum=0;
			for($i=0;$i<6;$i++){
				if($_COOKIE[$arr[$i]]>0){
					$p=(string)$flvr[$i][2];
					$sql = "SELECT R.pid,R.qty_reqd,Q.stock from reqd R, ingredient_detail Q where R.flvr_id='$p' and Q.pid=R.pid";
					$qty=mysqli_fetch_row(mysqli_query($con,$sql));
					$st=$qty[2]-$qty[1];
					$sql="update ingredient_detail set stock=$st where pid='$qty[0]';"; 
					mysqli_query($con,$sql);
					$sql = "select cost from Pizza_details where flvr_id='$p';";
					$cost=mysqli_fetch_row(mysqli_query($con,$sql));
					$sum = $sum + ($_COOKIE[$arr[$i]] * $cost[0]);
					$sql= "insert into order_qty values('$ordId[0]','$p','$us[0]','$qty[1]');";  
					mysqli_query($con,$sql);
					$sql= "insert into order_status values('$ordId[0]',1);";  
					mysqli_query($con,$sql);
					if($_COOKIE['take']==1){
						$sql= "insert into ord_type values('$ordId[0]','takeaway');";  
						mysqli_query($con,$sql);
					}
					else{
						$sql= "insert into ord_type values('$ordId[0]','home-delivery');";  
						mysqli_query($con,$sql);
					}
					$phone=$_COOKIE["phone"];
					$sql= "insert into ord_num values('$ordId[0]',$phone);";  
					mysqli_query($con,$sql);
				}
			}
			$total=$sum+(0.075*$sum);
			$_SESSION["sum"]=$sum;
			$_SESSION["total"]=$total;
			$_SESSION["oid"]=$ordId[0];
			header("location:./receipt.php");
		}	
		if(isset($_POST['modify'])){
			header("location:order.php");
		}	
	?>
<div id="container" style="height: 1050px;overflow: hidden" >
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
<form method="post" action="./review_order.php">
	<div id="review" style="height: 900px;width: 90%;background-color: grey;position: relative;top:100px;left: 80px">
		<h1 style="color: black;position: relative;top:30px;">Name : <?php echo strtoupper($rs[0]); ?> </h1>
		<h1 style="color: black;position: relative;top:-30px;left: 500px">Phone Number : <?php echo $ph; ?> </h1>
		<h1 style="color: black;position: relative;top:-30px;">Address : <?php echo "House No. ".$qr[0]."; ".$rs[1]."; ".$rs[2]; ?> </h1>
		<h1 style="color: black;position: relative;top:-30px;">Order : </h1><br>
	<div style="zoom:180%;position: relative;top:-30px;left: 50px">
		<?php
			$sum=0;
			echo "<table border=1><tr><th>Flavour</th><th>Quantity</th><th>Rate</th><th>Total</th></tr>";
			for($i=0;$i<6;$i++){
				if($_COOKIE[$arr[$i]]>0){
					$t=$flvr[$i][1] * $_COOKIE[$arr[$i]];
					$sum += $t;
					echo "<tr><th>".$flvr[$i][0]."</th><th>".$_COOKIE[$arr[$i]]."</th><th>".$flvr[$i][1]." $</th><th>".$t."</th></tr>";
				}
			}
			echo "</table><br>";
			$gst=(0.075*$sum);
        	$total=$sum+$gst;
		?>
	</div>
		<div style="position: relative;top: -320px;left: 750px">
			<h1 style="color: black;position: relative;font-size: 30px">Total Sum Amount : <?php echo $sum; ?> </h1>
			<h1 style="color: black;position: relative;font-size: 30px">GST Applicable (7.5%) : <?php echo $gst; ?> </h1>
			<h1 style="color: black;position: relative;font-size: 30px">Payable Amount : <?php echo $total; ?> </h1>
			<input type="submit" name="confirm" value="" style="background-image: url('./images/confirm.png');background-size:100% 100%;position: relative;left:-450px;top:0px;height: 110px;width: 150px;background-color: white">
			<input type="submit" name="modify" value="" style="background-image: url('./images/update2.png');background-size:100% 100%;position: relative;left:-430px;top:0px;height: 110px;width: 150px;background-color: white">			
		</div>
	</form>
		<div style="position: relative;top:-300px">
			<?php
				if($_COOKIE['delivery']>0){
			?>
			<h1 style="color: black;position: relative;font-size: 30px;top:-50px">HOME DELIVERY OPTION :</h1>
			<h1 style="color: black;position: relative;top:-60px;">Current Address : <?php echo "House No. ".$qr[0]."; ".$rs[1].";  ".$rs[2]; ?></h1>
			<h1 style="color: black;position: relative;top:-58px">Update Address : </h1>
		<form method="post" action="./review_order.php">
			<div style="border:2px solid black;width: 400px;height: 200px;position: relative;left: 300px;top:-120px;">
				<h1 style="color: black">House Number :</h1><input type="text" name="hno" style="position: relative;top:-45px;left:100px">
				<h1 style="position: relative;top:-45px;color: black">Street Name :</h1><input type="text" name="street" style="position: relative;top:-90px;left:100px">
				<h1 style="position: relative;top:-90px;color: black">City :</h1><input type="text" name="city" style="position: relative;top:-140px;left:130px">
				<input type="submit" name="update" value="UPDATE" style="position: relative;top:-110px;left:30px">
			</div> 
		</form>
			<?php } ?>
		</div>
	</div>
</div>

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