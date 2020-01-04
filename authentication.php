<?php
session_start();
include('dbconnect.php');
if(isset($_POST['submit'])){
    $regno=$_POST['regno'];
    $db=$_SESSION['college'].'db';
    $sql=$connect->query("select Regno from $db where Regno='$regno'");
    if($sql->num_rows!=0){
    $_SESSION['regno']=$regno;
    $table='election'.$_SESSION['college'];
    $_SESSION['table']=$table;
    $db=$_SESSION['college'].'db';
    if(isset($_SESSION['regno']))
    $insert=$connect->query("insert into $table(Regno) values('$regno')");
    $selectnum=$connect->query("select Contact from $db where Regno='$regno'");
    $row=mysqli_fetch_assoc($selectnum);
    $num=$row['Contact'];
    if(!$insert){
        $select=$connect->query("select Regno from $table where Regno='$regno'");
        
        if($select->num_rows!=0){
            if($selectnum->num_rows!=0){
			require('textlocal.class.php');

			$textlocal = new Textlocal(false,false,'2oauB3HNZwo-hlC0li2iWLvWhJzrK98F8RWCmQg3My');

			$numbers = array($num);
			$sender = 'TXTLCL';
			$otp=mt_rand(10000,99999);
			$message = 'Your OTP is '.$otp;

			try {
			    $result = $textlocal->sendSms($numbers, $message, $sender);
			    setcookie('otp',$otp);
			} catch (Exception $e) {
			    die('Error: 404'.$row['Contact'] . $e->getMessage());
			}
            header('location:verifyotp.php');
        } 
        else
        echo $connect->error;
        }
    }
    else{
            if($selectnum->num_rows!=0){
        	require('textlocal.class.php');
    
			$textlocal = new Textlocal(false,false,'2oauB3HNZwo-hlC0li2iWLvWhJzrK98F8RWCmQg3My');

			$numbers = array($num);
			$sender = 'TXTLCL';
			$otp=mt_rand(10000,99999);
			$message = 'Your OTP is '.$otp;

			try {
			    $result = $textlocal->sendSms($numbers, $message, $sender);
			    setcookie('otp',$otp);
			} catch (Exception $e) {
			    die('Error: ' . $e->getMessage());
			}
        header('location:verifyotp.php');
    }
    }
    }
    else{
        echo "<center><h2>You are not a valid Student!</h2></center>";
    }
}
if(isset($_POST['pollbtn'])){
    $_SESSION['college']=$_POST['pollbtn'];
?>
<html>
<head>
	<title>College Voting System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 	
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="animate.css">
	<link rel="stylesheet" type="text/css" href="font/flaticon.css">
</head>
<body>
	<!--Navbar-->
	<nav class="navbar navbar-expand-lg navbar-light bg-warning sticky-top">
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
	<!--check election date and time-->
	<?php
	$chk=$connect->query("select * from election where College_Name='$_SESSION[college]'");
	$row=mysqli_fetch_assoc($chk);
	if($chk->num_rows!=0){
	    date_default_timezone_set('Asia/Kolkata');
	    $today=date("Y-m-d");
	    $time=date("H:i:s");
	    if(($today>=$row['Edate']) and ($today<=$row['Rdate'])){
	            $now=$today.$time;
	            $res=$row['Rdate'].$row['Rtime'];
	            if($now<=$res){
	?>
	<br><br>
	<center>
	    <form action="" method="POST">
	    <input type="text" name="regno" placeholder="Enter your Registration Number" required>
	    <br><br>
	    <input type="submit" name="submit" value="Confirm" class="btn btn-outline-primary">
	    </form>
	</center>
	<?php
	        }
	        else{
	            echo "<br><br><br><center><h1>The Election is over!</h1><br><a href='result.php'><button class='btn btn-outline-success'>View Results</button></a></center>";
	        }
	        }
	    else if($today>$row['Rdate']){
	    	 echo "<br><br><br><center><h1>The Election is over!</h1><br><a href='result.php'><button class='btn btn-outline-success'>View Results</button></a></center>";
	    }
	    else
	        echo "<br><br><br><center><h1>The election is not until $row[Edate] at $row[Etime]</h1></center>";
	    
    }
    else{
        echo "<br><br><br><center><h1>The election will be conducted soon!</h1></center>";
    }
	}
	
	?>
	</body>
	</html>