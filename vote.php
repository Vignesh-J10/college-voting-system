<?php
session_start();
include('dbconnect.php');
$sql=$connect->query("select distinct College_Name from poll");
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
<!--College list-->
<br><br>
<center>
    <?php
    if($sql->num_rows!=0){
    ?>
        <h2>Select Your College</h2>
        <div class="row">
        <?php
            if($sql->num_rows!=0){
                while($result=mysqli_fetch_assoc($sql)){
         ?>
         <div class="col-sm-3 col-12">
                <form action="authentication.php" method="post">
                        <input type="submit" class="btn btn-info" name="pollbtn" id="getval" value='<?php echo $result["College_Name"];?>' style="width:250px">
                    </form>
            </div>
            <?php
            }   
        }
        }
        else{
            echo "<h1>There are no elections conducted currently!<br> Please Check again after sometime!!</h1>";
        }
        ?>
        </div>
</center>
</body>
</html>