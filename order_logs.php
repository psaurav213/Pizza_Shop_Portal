<?php
  include('session.php');
  $con=myConnection();
  $sql="select name from employee where emp_id=$user_check;";
  $us=mysqli_fetch_array(mysqli_query($con,$sql));
  $user=nameTrim($us["name"]);
  $gen="male";
  $a=array(32,22,31,45,1,1);
  $b=[];

  $sql ='select A.flvr_id,B.flvr_name,sum(A.qty)as freq from order_qty A,pizza B where A.flvr_id=B.flvr_id group by A.flvr_id order by freq DESC;';
  $ar=[];
  $qr=mysqli_query($con,$sql);
  while($r=mysqli_fetch_row($qr)){
    array_push($ar,$r[2]);
    array_push($b,$r[1]);
  }

?>
<html>
<head>
<title>Home</title>
<link rel="icon" href="./images/icon.png">
<link href='./CSS/emp_orlog.css' rel='stylesheet' type='text/css'></link>
<link href='./menu.css' rel='stylesheet' type='text/css'></link>
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
          ['<?php echo $b[4]; ?>',    <?php echo $ar[4]; ?>]
        ]);

        var options = {
          title: 'Pizza Frequecny Pie-chart',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
<div id="container" style="height: 1000px;overflow: hidden">
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

  <img src="images/order_logs.png" alt="Company's Logo" style="width:100%;height:100%;opacity: 0.3">
	<div id="content" style="position: fixed;top:100px;left: 350px;overflow: hidden;">

    <div id="frequency" style="">
        <strong><h1 style='font-size:50px;color: #FF5733'><?php echo "Frequency of Pizza:" ?></h1></strong>
    <?php
      $con=myConnection();
      $sql ='select A.flvr_id,B.pizza_name,sum(A.qty)as freq from order_qty A,pizza B where A.flvr_id=B.flvr_id group by A.flvr_id order by freq DESC;';
      mysqli_select_db($con,'pizza');
      $retval = mysqli_query($con,$sql);
      if(! $retval ) {
        die('Could not get data: ' . mysqli_error($con));
      }
      mysqli_close($con);
    ?>
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover" border='1'>
    <tr>
    <th><a>Flavour ID</a></th>
    <th><a>Flavour Name</a></th>
    <th><a>Sold Units</a></th>
    </tr>
        <?php
            If(mysqli_num_rows($retval)>0){
                 while($row=mysqli_fetch_array($retval)){  
        ?>
        <tr>
        <td><b><?php echo $row['flvr_id']; ?></b></td> 
        <td><b><?php echo $row['pizza_name']; ?></b></td> 
        <td><b><?php echo $row['freq']; ?></b></td>
        </tr>
        <?php
            }
      }
        ?>
  </table>
  </div>   

    </div>
              <div id="piechart_3d" style="width: 1000px; height: 370px;position: relative;top:50px;left: 00px"></div>

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


