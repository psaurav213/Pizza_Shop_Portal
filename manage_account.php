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
<div id="container" style="background-image: url(images/account.jpg);height: 1300px;overflow: hidden;" >
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
  
  <div id="content" style="position: relative;top:50px;left: 300px;">
    <div id="account_details" style="position: relative;left:-130px">
      <strong><h1 style='color:#FF5733;font-size:50'><?php echo "Account Details:" ?></h1></strong>
      <?php
      $conn=myConnection();
      $sql="SELECT * FROM employee where emp_id='$user_check';";
      $retval = mysqli_query($conn,$sql);
      $row=mysqli_fetch_array($retval);
      echo "<table id='details' border='2'><tr><td><a>Employee Id: </a></td><td>".$row['emp_id']."</td></tr>";
      echo "<tr><td><a>Name: </a></td><td>".$row['name']."</td></tr>";
      echo "<tr><td><a>Address: </a></td><td>".$row['streetname']."; ".$row['city']."</td></tr>";
      echo "<tr><td><a>Join Date: </a></td><td>".$row['join_date']."</td></tr>";
      echo "<tr><td><a>Email ID: </a></td><td>";
        $sql="SELECT mail FROM emp_mail where emp_id='$user_check';";
        $retval = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($retval)){
          echo $row['mail'].";";
        }
      echo "<tr><td><a>Phone: </a></td><td>";
        $sql="SELECT phone FROM emp_phone where emp_id='$user_check';";
        $retval = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($retval)){
          echo $row['phone'].";";
        }
      echo "</td></tr></table>";
      mysqli_close($conn);
    ?>
  </div>
  <div id="update" style="position: relative;left: -130px;top:-10px">
    <strong><h1 style='color:#FF5733;font-size:50'><?php echo "Update Details" ?></h1></strong>
    <?php 
        if(isset($_POST['updatenm'])) {
              if(empty($_POST["name"])){
                myAlert("Name not entered!");
              }
              else{
              myConnection();
              $id = $user_check;
              $name = $_POST['name'];
              $sql = "update employee set name='$name' where emp_id='$id'";
              $retval = mysqli_query($con,$sql );
              if(! $retval ) {
                  die('Could not update data: ' . mysqli_error($con));
              }
              header('Location: '.$_SERVER['PHP_SELF']);
              mysqli_close($con);}
        }


        if(isset($_POST['updatead'])) {
            if(empty($_POST["street1"]) && empty($_POST["city"])){
                myAlert("Both fields cannot be left empty!");
            }
            else{
            $con=myConnection();
            $id = $user_check;
            $sup="select streetname,city from employee where emp_id='$id'";
            $ret = mysqli_fetch_array(mysqli_query($con,$sup ));
            print_r($ret["streetname"]);
            $street = $_POST['street1'];
            $city = $_POST['city'];
            if(empty($street)){
              $street=$ret["streetname"];
            }
            if(empty($city)){
              $city=$ret["city"];
            }
            
            $sql = "update employee set streetname='$street', city='$city' where emp_id='$id'";
            $retval = mysqli_query($con,$sql );
            if(! $retval ) {
               die('Could not update data: ' . mysqli_error($con));
            }
            echo "Updated data successfully\n";
            header('Location: '.$_SERVER['PHP_SELF']);
            mysqli_close($con); }
        }

        if(isset($_POST['updatepass'])) {
          if(empty($_POST['pass'] && $_POST['opass'])){
            myAlert("Both fields are required!");
          }
          else{
            $con=myConnection();
            $id = $user_check;
            $pass = $_POST['pass'];
            $opass= $_POST['opass'];
            $sql = "select password from authentication where emp_id='$id';";
            $a01 =mysqli_query($con,$sql);
            while($row=mysqli_fetch_array($a01)){
              $a_01 =$row['password'];
            }
        if($opass==$a_01){
            $sql = "update authentication set password='$pass' where emp_id='$id'";
            $retval = mysqli_query($con,$sql );
            if(! $retval ) {
               die('Could not update data: ' . mysqli_error($con));
            }
            header('Location: logout.php');
            mysqli_close($con);
      }
      else{
        myAlert("You have entered wrong current password!");
      }}}

      if(isset($_POST['updateph'])) {
        if(empty($_POST['phone'])){
            myAlert("Enter Phone Number to add into account!");
          }
        else{
        $con=myConnection();
        $id = $user_check;
        $phone = $_POST['phone'];
        $sql = "insert into emp_phone values('$phone','$id');";
        $retval = mysqli_query($con,$sql );
        if(! $retval ) {
          die('Could not update data: ' . mysqli_error($con));
        }
        header('Location: '.$_SERVER['PHP_SELF']);
        mysqli_close($con);
      }}

      if(isset($_POST['delphone'])) {
        if(empty($_POST['del_phn'])){
            myAlert("No Number in Directory!");
          }
        else{
        $con=myConnection();
        $oldph=$_POST['del_phn'];
        $sql = "delete from emp_phone where phone='$oldph'";
        $retval = mysqli_query($con,$sql );
        if(! $retval ) {
          die('Could not update data: ' . mysqli_error($con));
        }
        header('Location: '.$_SERVER['PHP_SELF']);
        mysqli_close($con);
      }}

      if(isset($_POST['updateml'])) {
        if(empty($_POST['mail'])){
            myAlert("Enter E-mail to add into account!");
          }
        else{
        $con=myConnection();
        $id = $user_check;
        $mail = $_POST['mail'];
        $sql = "insert into emp_mail values('$mail','$id');";
        $retval = mysqli_query($con,$sql );
        if(! $retval ) {
          die('Could not update data: ' . mysqli_error($con));
        }
        header('Location: '.$_SERVER['PHP_SELF']);
        mysqli_close($con);
      }}

      if(isset($_POST['updatemail'])) {
        if(empty($_POST['del_mail'])){
            myAlert("No Number in Directory!");
          }
        else{
        $con=myConnection();
        $oldml=$_POST['del_mail'];
        $sql = "delete from emp_mail where mail='$oldml'";
        $retval = mysqli_query($con,$sql );
        if(! $retval ) {
          die('Could not update data: ' . mysqli_error($con));
        }
        header('Location: '.$_SERVER['PHP_SELF']);
        mysqli_close($con);
      }}

    ?>
        <form method = "post" action = "<?php $_PHP_SELF ?>" style="position: relative;left: -230px">
            <div style="position: relative;left:-234px">
            <a>Name:</a> <input type="text" name="name">
            <input type="submit" name="updatenm" value="UPDATE"><br><br>
            </div>
            <div style="position: relative;left:-40px;">
              <a>Street Name:</a> <input type="text" name="street1">
              <a>City Name:</a> <input type="text" name="city">
              <input type="submit" name="updatead" value="UPDATE"><br><br>
            </div>
            <div style="position: relative;left:230px;border: 2px solid black;width: 850px">
              <a style="font-size: 20;color:#FF5733;position: relative;left: -315px">Change Password</a><br>
              <a>Current Password: </a> <input type="password" name="opass">
              <a>New Password: </a> <input type="password" name="pass">
              <input type="submit" name="updatepass" value="UPDATE"><br><br>
            </div>
            <div style="position: relative;left:230px;top:50px;border: 2px solid black;width: 850px">
              <a style="font-size: 20;color:#FF5733;position: relative;left: -300px">Add Phone Number</a><br>
              <div style="position: relative;left:-185px">
              <a>Phone Number:</a> <input type="text" name="phone">
              <input type="submit" name="updateph" value="UPDATE"><br><br>
            </div>
              <a style="font-size: 20;color:#FF5733;position: relative;left: -300px">Delete Phone Number</a><br>
              <div style="position: relative;left:-185px">
              <a>Select Phone Number: </a> <select name="del_phn">
                <?php
                    $con=myConnection();
                    $id = $user_check;
                    $sql = "select phone from emp_phone where emp_id='$id';";
                    $a01 =mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($a01)){?>
                        <option name='del_phn' value="<?php echo $row['phone'];?>" style="position: relative;left:-285px"> <?php echo $row['phone']; ?></option>
                    <?php }                      
                ?>
              </select>
              <input type="submit" name="delphone" value="DELETE"><br><br>
            </div>
            </div>

            <div style="position: relative;left:230px;top:100px;border: 2px solid black;width: 850px">
              <a style="font-size: 20;color:#FF5733;position: relative;left: -300px">Add New E-mail</a><br>
              <div style="position: relative;left:-185px">
              <a>E-mail:</a> <input type="text" name="mail">
              <input type="submit" name="updateml" value="UPDATE"><br><br>
            </div>
              <a style="font-size: 20;color:#FF5733;position: relative;left: -300px">Delete E-mail: </a><br>
              <div style="position: relative;left:-185px">
              <a>Select E-mail: </a> <select name="del_mail">
                <?php
                    $con=myConnection();
                    $id = $user_check;
                    $sql = "select mail from emp_mail where emp_id='$id';";
                    $a01 =mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($a01)){?>
                        <option name='del_mail' value="<?php echo $row['mail'];?>" style="position: relative;left:-285px"> <?php echo $row['mail']; ?></option>
                    <?php }                      
                ?>
              </select>
              <input type="submit" name="updatemail" value="DELETE"><br><br>
            </div>
            </div>
        </form>



  </div>

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
    <h1 style="font-family: helvetica;font-size: 20;text-decoration:none;color:white;padding-left: 20px;position: relative;top:-70px;left:200px">HELLO<br> <?php echo $user; ?></h1>
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


