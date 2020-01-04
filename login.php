<?php
//if user clicks login,collect the datas and process
session_start();
$isIndex = 1;
if(array_key_exists('clgname',$_SESSION) && isset($_SESSION['clgname'])) {
    header('Location: user.php');
} 
else {
    if(!$isIndex) 
        header('Location: index.php');
}
if(isset($_POST['login'])){
    include('dbconnect.php');
    $email=$_POST['email'];
    $p=$_POST['password'];
    $p=md5($p);
    $resultset=$connect->query("select * from clg where Email='$email' and Password='$p' LIMIT 1");
    if($resultset->num_rows!=0){
        $row=$resultset->fetch_assoc();
        $verified=$row['Mail_Status'];
        $createdate=$row['Date_Of_Creation'];
        $createdate=strtotime($createdate);
        $createdate=date('M d Y',$createdate);
        //to check whether the mail is verified
        if($verified==1){
            //session_start();
            $getname=$row['College_Name'];
            $_SESSION['clgname']=$getname;
            header('location: user.php');
            exit();
        }
        //if mail is registered but not verified
        else{
            echo "<br><br><br><br><br><center><h3>Your account has not yet been verified. An email has sent to $email on $createdate<br><br>Verify and then <br><br>Login</h3></center>";
        }
    }
    //if login datas are not correct
    else{
        $mailexist=$connect->query("select * from clg where Email='$email' LIMIT 1");
        //to check whether mail exist,if mail exist the password is wrong
        if($mailexist->num_rows!=0){
            echo "<br><br><br><br><br><center><h3>Password Incorrect!!<br><br>Try Again!</h3></center>";
        }
        //account not registered
        else{
        echo "<br><br><br><br><br><center><h3>You're not a Registered User!<br><br><a href='register.php'><button name='submit' class='btn btn-success'>Register Now</button></a></h3></center>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 	
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="animate.css">
	<link rel="stylesheet" type="text/css" href="font/flaticon.css">
	    <script>
        function showPassword() {
          var x = document.getElementById("myInput");
          if (x.type == "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d866926c22bdd393bb70e45/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>
<body>
	<!--Navbar-->
	<nav class="navbar navbar-expand-lg  fixed-top">
	  		<a class="navbar-brand" href="index.html">College Voting System</a>
	  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    		<span class="navbar-toggler-icon"></span>
	  		</button>
	  	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    <div class="navbar-nav ml-auto">
		      <a class="nav-item nav-link" href="vote.php">Cast your Vote</a> 
		      <a class="nav-item nav-link" href="register.php">Create a New Account</a>
		      <a class="nav-item nav-link" href="login.php">Login</a>
		      <a class="nav-item nav-link" href="complaint.html">Report/Complaint</a>
		    </div>
	  	</div>
	</nav>
	<!--Login form-->
	<div class="loginform">
		<form action="login.php" method="post" name="login">
			<center>
				<input type="email" name="email" placeholder="E-Mail ID" required><br><br>
				<input type="password" name="password" placeholder="Password" id="myInput" required><br><br>
				<a href="forget.php">Forget Password?</a><br>
				<input type="checkbox" onclick="showPassword()"> Show Password<br>
				<button type="submit" class="btn btn-success" name="login">Submit</button><br>
				
			</center>
		</form>
	</div>
</head>
</html>