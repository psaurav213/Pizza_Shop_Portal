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
		$ph=$_COOKIE["phone"];
		$sql="SELECT C.cust_id from customer C where C.cust_id =(SELECT A.cust_id from cust_phone A where A.phone='$ph');";
		$us=mysqli_fetch_row(mysqli_query($con,$sql));
		$sql="SELECT C.name,C.streetname,C.city from customer C where C.cust_id =(SELECT A.cust_id from cust_phone A where A.phone='$ph');";
		$rs=mysqli_fetch_row(mysqli_query($con,$sql));
		$arr=array("Margherita","Double-Cheese-Margherita","Farm-House","Peppy-Paneer","Mexican-Green Wave","Delux-Vegie");
		$sql="SELECT F.flvr_name ,C.cost,F.flvr_id from icecream F,Pizza_details C where F.flvr_id=C.flvr_id;";
		$flvr=[];
		$qr=mysqli_query($con,$sql);
		while($r=mysqli_fetch_row($qr)){
			array_push($flvr,array($r[0],$r[1],$r[2]));
		}
		$sql="SELECT D.hno from house D where cust_id=(SELECT cust_id from customer C where C.cust_id =(SELECT A.cust_id from cust_phone A where A.phone='$ph'));";
		$qr=mysqli_fetch_row(mysqli_query($con,$sql));
		
	?>
<div id="container" style="background-color: white;height: 1050px;overflow: hidden" >
	<div id="revId" >
			<img src="images/logo.png" alt="Company's Logo" style="width:250px;height:195px; position: relative; top:10px;padding-top: 2px;left:-500px">
			<h1 style="font-style: italic;font-size:60;position: relative;top:-140px;left:400px;color: black">Tim & Doug's Icecreams</h1>
			<h1 style="font-style: italic;font-size:20;position: relative;top:-180px;left:1000px;color: black">Since 1975</h1>
			<h1 style="color: black;position: relative;top:-120px;left: 290px">Order ID : <?php echo $_SESSION['oid']; ?> </h1>
			<img src="images/invoice.png"  style="width:150px;height:125px; position: relative; top:-220px;padding-top: 2px;left:-500px">


	</div>

	<div id="review" style="height: 900px;width: 90%;background-color: white;position: relative;top:-200px;left: 80px">
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
			<h1 style="color: black;position: relative;font-size: 30px">Total Sum Amount : <?php echo $_SESSION["sum"]; ?> </h1>
			<h1 style="color: black;position: relative;font-size: 30px">GST Applicable (7.5%) : <?php echo ($_SESSION["sum"] * 0.075); ?> </h1>
			<h1 style="color: black;position: relative;font-size: 30px">Payable Amount : <?php echo $_SESSION["total"]; ?> </h1>
		</div>

	</div>
	<a href="./home.php"><img src="images/home.png"  style="width:100px;height:85px; position: relative; top:-1500px;padding-top: 2px;left:570px"></a>
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