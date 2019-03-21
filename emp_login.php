<?php
	include("config.php");
   session_start();
   $error="Enter details.";
   if(isset($_POST["submit"])) {
      if(empty($_POST["username"]) || empty($_POST["password"]) ||empty($_POST['captcha'])){
         $error="All fields are required";
      }
      else{
         $myStr=(string)$_SESSION["cap"];
         $cp=(string)$_POST['captcha'];
         if(strcmp($cp,$myStr)==0){
            $myusername = $_POST['username'];
            $mypassword = $_POST['password']; 
            $sql = "SELECT emp_id FROM authentication WHERE  emp_id= '$myusername' and password = '$mypassword'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count == 1) {
               $_SESSION['login_user'] = $myusername;
               header("location: manage_ingredients.php");
            }
            else {
               $error = "Invalid Details";
            }
            
         }
         else{
            myAlert("You have entered wrong captcha.");
      }
   }
}
?>
<html>
   <head>
      <title>Login Page</title>
      <link href='./CSS/login.css' rel='stylesheet' type='text/css'></link>
	  
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

   </head>
<body>
<img src="images/login.jpg" style="height: 100%;width: 100%;">
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
         <div id="login_box">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;" align="center"><b>Login</b></div>
               <form  method = "post" style="position: relative;top:20px" align="center">
                  <label>Employee Id  :</label><input type = "text" name = "username" class = "box" style="position: relative;left:10px"><br /><br />
                  <label style="position: relative;left:-10px" >Password  :</label><input type = "password" name = "password" class = "box"  style="position: relative;left:17px"><br><br>
                  <label style="position: relative;left:100px;top:-10px">Enter Captcha</label><input type="text" name="captcha" style="position: relative;top:10px"><br><br>
                  <div id="captchaBox" style="border:2px solid black;width:90px;height:50px;position: relative;top:-50px;left: 25px">
                     <img src="captcha.php">
                  </div><br>
                  <input type = "submit" name = "submit" style="position: relative;left:-115px;top:-51px" /><br />
                  <span class="error" style="position: relative;top:-100px;left:40px"><p1 style="font-family: helvetica;font-size: 15;color:red;"><?php echo $error;?></p1></span>
               </form>
         </div>
         <div id="forget" style="position: fixed;top:255px;left:220px;zoom:250%">
         <button id="frgt" onclick="alert('Kindly, Contact your administrator.')"">Forgot Details</button>
         </div>

   </body>
</html>