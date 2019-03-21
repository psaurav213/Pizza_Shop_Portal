<?php  
 $connect = mysqli_connect("localhost", "root", "", "pizza");  
 $query = "SELECT gender, count(*) as number FROM tbl_employee GROUP BY gender";  
 $result = mysqli_query($connect, $query);  
 ?>  
<html>
<head>
<title>Home</title>
<link rel="icon" href="./images/icon.png">
<link href='./CSS/emp_acc1.css' rel='stylesheet' type='text/css'></link>
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
<div id="container" style=";height: 1300px;overflow: scroll;" >
	<header>
		<div id='nav'>
			<img src="images/logo.jpg" alt="Company's Logo" style="width:100px;height:95px; position: relative; left:-1300px;padding-top: 2px">
			<h1 style="font-style: italic;font-size:30;position: relative;top:-80px;left:200px">Tim & Doug's Icecreams</h1>
			<a href='./home.php'>Home</a>
      <a href='./employee.php'>Employee</a>
      <a href='./menu.php'>Menu</a>
      <a href='./order.php'>Order</a>
      <a href='./feedback.php'>Feedback</a>
      <a href='./about.php'>About Us</a>
		</div>
	</header>
  
<div id="content" style="background-color: red;position: relative;top:100px;left: 0px;">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["gender"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Male and Female Employee',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
</script>  
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
    <a href="./manage_order.php" style="position: relative;top:30px;">MANAGE ORDER</a><br>
    <a href="./order_logs.php" style="position: relative;top:50px;">ORDER LOGS</a><br>
    <a href="process_order.php" style="position: relative;top:70px;">PROCESS ORDERS</a><br>
    <a href="manage_account.php" style="position: relative;top:90px;">MANAGE ACCOUNT</a><br>
  </div>
  <div id="checkout">
    <a href="./logout.php" style="position: relative;top:-30px;left: -10px"><img src="images/logout.png" alt="Company's Logo" style="width:80px;height:60px;position: relative;">SIGN-OUT</a>
  </div>
</div>

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

function nameTrim($n){
  $nm=explode(" ",$n);
  return $nm[0];
}

function update_name(){
  
}

?>

</body>
</html>


