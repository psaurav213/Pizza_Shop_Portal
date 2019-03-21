<?php
  session_start();
	include('session.php');
  $con=myConnection();
  $sql="select name from employee where emp_id=$user_check;";
	$us=mysqli_fetch_array(mysqli_query($con,$sql));
  $user=nameTrim($us["name"]);
	$gen="male";
	$a=array(32,22,31,45,1,1);
	$sql="SELECT F.flvr_name from icecream F,icecream_details C where F.flvr_id=C.flvr_id;";
	$b=[];
	$qr=mysqli_query($con,$sql);
	while($r=mysqli_fetch_row($qr)){
		array_push($b,$r[0]);
	}
	$sql ='select A.flvr_id,B.flvr_name,count(A.flvr_id)as freq from order_qty A,icecream B where A.flvr_id=B.flvr_id group by A.flvr_id order by freq DESC;';
	$ar=[];
	$qr=mysqli_query($con,$sql);
	while($r=mysqli_fetch_row($qr)){
		array_push($ar,$r[2]);
	}

?>
<html>
  <head>
  	<link rel="icon" href="./images/icon.ico">
	<link href='./CSS/analytics.css' rel='stylesheet' type='text/css'></link>
    <script type="text/javascript" src="./loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['<?php echo $b[0]; ?>',     <?php echo $ar[0]; ?>],
          ['<?php echo $b[1]; ?>',      <?php echo $ar[1]; ?>],
          ['<?php echo $b[2]; ?>',  <?php echo $ar[2]; ?>],
          ['<?php echo $b[3]; ?>', <?php echo $ar[3]; ?>],
          ['<?php echo $b[4]; ?>',    <?php echo $a[4]; ?>]
        ]);

        var options = {
          title: 'Ice-cream Frequecny Pie-chart',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Day');
      data.addColumn('number', 'Guardians of the Galaxy');
      data.addColumn('number', 'The Avengers');
      data.addColumn('number', 'Transformers: Age of Extinction');

      data.addRows([
        [1,  37.8, 80.8, 41.8],
        [2,  30.9, 61.5, 32.4],
        [3,  25.4,   57, 25.7],
        [4,  11.7, 18.8, 10.5],
        [5,  11.9, 17.6, 10.4],
        [6,   8.8, 13.6,  7.7],
        [7,   7.6, 12.3,  9.6],
        [8,  12.3, 29.2, 10.6],
        [9,  16.9, 42.9, 14.8],
        [10, 12.8, 30.9, 11.6],
        [11,  5.3,  7.9,  4.7],
        [12,  6.6,  8.4,  5.2],
        [13,  4.8,  6.3,  3.6],
        [14,  4.2,  6.2,  3.4]
      ]);

      var options = {
        chart: {
          title: 'Yearly Sale Revenue',
          subtitle: 'in Rupees'
        },
        width: 1100,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));
      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 1100px; height: 500px;position: relative;top:100px;left: 300px"></div>
    <div id="line_top_x" style="position: relative;top:100px;left: 300px"></div>
    <div id="barchart_material" style="width: 1100px; height: 500px;position: relative;top:100px;left: 300px"></div>
    <div id="container" style="background-color: white;height:100px;width: 1100px;" >
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
  </body>
</html>

<?php 
function myAlert($msg){
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function myConnection(){
  $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = 'dbms';
      $db='parlour';
      $con = mysqli_connect($dbhost,$dbuser,$dbpass,$db);
      if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      mysqli_select_db($con,'parlour');
  return $con;
}

function nameTrim($n){
  $nm=explode(" ",$n);
  return $nm[0];
}
?>