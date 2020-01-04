<?php
    include('dbconnect.php');
    session_start();
    if(isset($_POST['change'])){
    //data filter
    $email=$_SESSION['mail'];
    //check whther data already exist
    $sql=$connect->query("select * from clg where Email='$email'");
    //fetch datas
    $row = mysqli_fetch_assoc($sql);
    //check whether clgname and email already exist
    $p=$_POST['password1'];
    $p2=$_POST['password2'];
    //check for password mismatch,if any
    if($p!=$p2){
    echo '<br><br><br><center><h2>Password doesnt match</h2></center>';
    }
    else{
    	$p=md5($p);
        $sql=$connect->query("update clg set Password='$p' where Email='$email'");
        if($sql){
            echo "<br><br><br><center><h2>Password has been changed successfully!</h2></center>";
            header("refresh:2;url=login.php");
        }
    }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 	
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="animate.css">
	<link rel="stylesheet" type="text/css" href="font/flaticon.css">
	<script>  
function validateform(){  
var name=document.register.name.value;  
var password=document.register.password1.value;  
  
if (name==null || name==""){  
  alert("Name can't be blank");  
  return false;  
}else if(password.length<8){  
  alert("Password must be at least 8 characters long.");  
  return false;  
  }  
}  
function showPassword() {
  var x = document.getElementById("myInput");
  var y = document.getElementById("myInput2");
  if (x.type === "password" && y.type=="password") {
    x.type = "text";
    y.type="text";
  } else {
    x.type = "password";
    y.type="password";
  }
}
</script>
</head>
<body>
	<!--Navbar-->
	<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
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
	<!--Forgot Mail-->
		<div class="loginform">
		<form action="" method="post" name="forgot">
			<center>
				<input type="password" name="password1" id="myInput" placeholder="Password" required><br><br>
				<input type="password" name="password2" id="myInput2" placeholder="Repeat Password" required><br><br>
				<input type="checkbox" onclick="showPassword()"> Show Password<br>
				<input type="submit" class="btn btn-success" name="change" value="Submit"><br>
			</center>
		</form>
	</div>
</body>
</html>