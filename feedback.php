<?php
			$error="*All Fields are required!";
         
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$conn=myConnection();
				if($_POST['phone']!=NULL  && $_POST['rate']!=NULL && $_POST['cmt']!=NULL){
				$phone = $_POST['phone'];
				$sql = "select cust_id from cust_phone where phone='$phone';";
				$db='pizza';
				mysqli_select_db($conn,$db);
				$r01 =mysqli_query($conn,$sql);
				while($row=mysqli_fetch_array($r01)){
				$id =$row['cust_id'];
				}
				if($id!=NULL){
					$rt=$_POST['rate'];
					$cmt=$_POST['cmt'];
					$sql = "insert into feedback (cust_id) values('$id');";  
					mysqli_select_db($conn,$db);
					$retval = mysqli_query($conn,$sql);
					$sql="SELECT fid FROM feedback ORDER BY fid DESC LIMIT 1;";
					$retval = mysqli_query($conn,$sql);
					while($row=mysqli_fetch_array($retval)){
						$lod =$row['fid'];
					}
					$sql = "insert into comments values('$lod','$cmt','$rt');";  
						mysqli_select_db($conn,'pizza');
						$retval = mysqli_query($conn,$sql);
						myAlert("Thank you for ur valuable suggestions.");
				}
				else{
					$error="No such phone number registered!";
					myAlert("We will update your details during your purchase with us. ThankYou.");
				}
			}
			else{
				$error = "All fields must be filled to be continued";
			}
		 }
?>
<html>
<head>
    <title>Feedback Page</title>
     <link href='./feedback.css' rel='stylesheet' type='text/css'></link>
	 
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
	<img src="images/feedback.jpg" style="height: 100%;width: 100%;opacity: 0.18">
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
   	<center><p style='font-size:80;position:fixed;top:10px;left: 300px;color:orange;'><?php echo"We value our customers!"; ?></p></center>
    <div id="form_box">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;" align="center"><b>Provide Suggestions</b></div>
        <form  method = "post" style="position: relative;top:20px;left:15px" align="left">
            Phone Number: <input type = "numeric" name = "phone"><br><br>
            Rate Us: <input type = "radio" name = "rate" value = "1">1
                  	<input type = "radio" name = "rate" value = "2">2
				  	<input type = "radio" name = "rate" value = "3">3
				  	<input type = "radio" name = "rate" value = "4">4
				  	<input type = "radio" name = "rate" value = "5">5<br><br>
			<div style="position: relative;top:-10px">
            	Comments:<br>
                <textarea name = "cmt" rows = "3" cols = "35"></textarea><br><br>
            </div>
            <div style="position: relative;top:-10px">
			  	<input type = "submit" name = "submit" value = "Submit"> 
			   	<span class="error" style="position: relative;left:2px"><p1 style="font-family: helvetica;font-size: 15;color:red;"><?php echo $error;?></p1></span>
			</div>
                  
        </form>
    </div>
</body>


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

</html>