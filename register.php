<?php
//register.php
$isIndex = 1;
session_start();
if(array_key_exists('clgname',$_SESSION) && isset($_SESSION['clgname'])) {
    header('Location: user.php');
}
else {
    if(!$isIndex) 
        header('Location: index.php');
}
//if user clicks register
if(isset($_POST['register'])){
    //get details
    $name=$_POST['name'];
    $location=$_POST['location'];
    $email=$_POST['email'];
    $p=$_POST['password1'];
    $p2=$_POST['password2'];
    //check for password mismatch,if any
    if($p!=$p2){
    echo 'Password doesnt match';
    }
    //if not connect to db
    else{
    include('dbconnect.php');
    //session_start();
    //check for error
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    //data filter
    $name=$connect->real_escape_string($name);
    $location=$connect->real_escape_string($location);
    $p=$connect->real_escape_string($p);
    $email=$connect->real_escape_string($email);
    $acode=md5(time().$name);
    //change password of user before inserting into db in a more secure manner for security of users
    $p=md5($p);
    //check whther data already exust
    $sql="select * from clg where (College_Name='$name' or Email='$email');";
    //pass the query
    $res=$connect->query($sql);
    //fetch datas
    $row = mysqli_fetch_assoc($res);
    //check whether clgname and email already exist
    if($name!=$row['College_Name']){
        if($email!=$row['Email']){
            $sql=$connect->query("insert into clg values('$name','$location','$email','$p','$acode',0,CURRENT_TIMESTAMP,0)");
            //send an email to registered user
            if($sql){
                $to=$email;
                $subject="Email Verification";
                $message="<a href='www.collegevotingsystem.in.net/verify.php?acode=$acode'>Register Account</a>";
                $headers= "Reply-To: collegev@collegevotingsystem.in.net \r\n";
                $headers= "Return-Path: collegev@collegevotingsystem.in.net \r\n";
                $headers= "From: collegev@collegevotingsystem.in.net \r\n";
                $headers .="MIME-Version: 1.0" . "\r\n";
                $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
                mail($to,$subject,$message,$headers);
                header('location: success.html');
            }
            //errorcheck
            else{
                echo $connect->error;
                }
        }
        //if mail already exist
        else{
            echo "<br><br><br><br><br><center><h2>Email already exist</h2></center>";
            echo" <center><a href='index.html'><button type='submit' class='btn btn-success'>Back to Home</button></a></center>";
        }
    }
    //if college name already exist
    else{
        echo "<br><br><br><br><br><center><h2>College Name already exist</h2></center>";
            echo" <center><a href='register.html'><button type='submit' class='btn btn-success'>Try Again</button></a></center>";
    }
}
}
?>
<html>
<head>
<title>Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" type="text/css" href="animate.css">
<link rel="stylesheet" type="text/css" href="font/flaticon.css">
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
<!--Register-->
<div class="regform">
		<form action="register.php" method="post" name="register" onsubmit="return validateform()">
			<center>
				<input type="text" name="name" placeholder="College Name" required><br><br>
				<input type="text" name="location" placeholder="Location" required><br><br>
				<input type="email" name="email" placeholder="Official College E-Mail ID" required><br><br>
				<input type="password" name="password1" placeholder="Password" id="myInput" required><br><br>
				<input type="password" name="password2" placeholder="Repeat Password" id="myInput2" required><br><br>
				<input type="checkbox" onclick="showPassword()"> Show Password<br>
				<button type="submit" name="register" class="btn btn-success">Submit</button>
			</center>
		</form>
	</div>
</head>
</html>