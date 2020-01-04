<?php
include('dbconnect.php');
session_start();
if(isset($_SESSION['clgname'])){
$gotname=$_SESSION['clgname'];
if(isset($_POST['pollbtn'])){
    $poll=$_POST['pollbtn'];
    $sql=$connect->query("delete from poll where Name='$poll' and College_Name='$gotname'");
    $polltable=$poll.$_SESSION['clgname'];
    $sql2=$connect->query("drop table $polltable");
    header("location:user.php");
}
else
echo $connect->error;
?>
<html>
    <head>
    	<title>College Voting System</title>
    	<meta name='viewport' content='width=device-width, initial-scale=1'>
    	<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    	<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script> 	
    	<link rel='stylesheet' type='text/css' href='style.css'>
    	<link rel='stylesheet' type='text/css' href='animate.css'>
    	<link rel='stylesheet' type='text/css' href='font/flaticon.css'>
    </head>
    <?php 
    if(!isset($_SESSION['clgname'])){
    echo "<br><br><br><br><br><br><br><br><br><center><h3>Session timeout!!<br><br><a href='login.html'><button name='submit' class='btn btn-success'>Login</button></a></h3></center>";
}else{
    ?>
<body>
    <nav class='navbar navbar-expand-lg navbar-light bg-warning fixed-top'>
        	  		<a class='navbar-brand'>College Voting System</a>
        	  		<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
        	    		<span class='navbar-toggler-icon'></span>
        	  		</button>
        	  	<div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
        		    <div class='navbar-nav ml-auto'>
        		      <a class='nav-item nav-link' href='complaint.html'>Report/Complaint</a>
        		      <a class='nav-item nav-link' href='user.php' id='clgname'><?php echo $gotname?></a>
        		      <a class='nav-item nav-link' href='logout.php'>Logout</a>
        		    </div>
        	  	</div>
        	</nav>
<!--Poll-->
<br><br><br><br>
<center>
<div class="row">
<?php
$check=$connect->query("select Name from poll where College_Name='$gotname'");
if($check->num_rows!=0){
    while($res=mysqli_fetch_assoc($check)){
?>
    <div class="col-sm-3 col-6">
        <center>
            <form action="" method="post">
                <input type="submit" class="btn btn-outline-dark" name="pollbtn" value='<?php echo $res["Name"];?>' onclick="return confirm('Are you sure? Do You want to delete <?php echo $res["Name"];?>')">
            </form>
        </center>
   </div>
   <?php
}}}}
?>

</div>
<br>
</center>
</body>
</html>