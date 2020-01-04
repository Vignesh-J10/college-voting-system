<?php
include('dbconnect.php');
session_start();
if(isset($_SESSION['clgname'])){
$gotname=$_SESSION['clgname'];
if(isset($_POST['createpoll'])){
$pollname=$_POST['nop'];
$sql=$connect->query("insert into poll values('$pollname','$gotname',0)");
if(!$sql){
    $sql2=$connect->query("select Name from poll where College_Name='$gotname'");
    $row2=mysqli_fetch_assoc($sql2);
    if($row2['Name']==$pollname)
    echo '<h2>Poll already exist</h2>';
}
else{
    $pollname=$pollname.$_SESSION['clgname'];
    $sql=$connect->query("create table $pollname(Name varchar(30),Dept varchar(30),Year varchar(5))");
    $_SESSION['pollname']=$pollname;
    header("location:user.php");
}}
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
    echo "<br><br><br><br><br><br><br><br><br><center><h3>Session timeout!!<br><br><a href='login.php'><button name='submit' class='btn btn-success'>Login</button></a></h3></center>";
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
        		      <a class='nav-item nav-link' href='' id='clgname'><?php echo $gotname?></a>
        		      <a class='nav-item nav-link' href='logout.php'>Logout</a>
        		    </div>
        	  	</div>
        	</nav>
	<!--Poll-->
	<?php
    $chk=$connect->query("select Conduct from clg where College_Name='$_SESSION[clgname]'");
    $res=mysqli_fetch_assoc($chk);
	if($res['Conduct']!=1){
	?>
	<center>
	<div class="card pcard" style="width: 15rem;margin-top:15%">
      <div class="card-body">
        <center><h2>Create Poll</h2><a href="#" class="btn btn-primary btn-lg" role="button"  data-toggle="modal" data-target="#poll" aria-pressed="true" style="border-radius:50%;margin:15%;"><b>+</b></a></center>
      </div>
    </div>
	</center>
	
	<!-- Modal -->
<div class="modal fade" id="poll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Poll</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="" method="POST">
          <center><input type='text' placeholder='Name of the Poll' name="nop" required></center><br>
        </div>
        <div class="modal-footer">
        <center><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="createpoll" value="Submit"></center>
        </form>
      </div>
    </div>
  </div>
</div>
<br>
<?php
	}
	?>
<!--Poll-->
<center><br><br><br>
<div class="row">
<?php
$check=$connect->query("select Name from poll where College_Name='$gotname'");
if($check->num_rows!=0){
    while($res=mysqli_fetch_assoc($check)){
?>
    <div class="col-sm-3 col-6">
        <center>
            <form action="candidates.php" method="post">
                <input type="submit" class="btn btn-outline-dark" name="pollbtn" id="getval" value='<?php echo $res["Name"];?>'>
            </form>
        </center>
   </div>
   <?php
}}}}?>
</div>
<br>
</center>
<?php
$check=$connect->query("select Name from poll where College_Name='$gotname'");
$check3=$connect->query("select Conduct from clg where College_Name='$gotname'");
$row2=mysqli_fetch_assoc($check3);
if(($check->num_rows!=0) and $row2['Conduct']!=1){
?>
<form action="deletepoll.php" method="post">
    <center><input type="submit" class="btn btn-outline-danger" value="Delete a Poll"></center>
</form>
<?php
}
if($check->num_rows>0){
    $check2=$connect->query("select Status from poll where College_Name='$_SESSION[clgname]' order by Status asc");
    $check3=$connect->query("select Conduct from clg where College_Name='$gotname'");
    $row=mysqli_fetch_assoc($check2);
    $row2=mysqli_fetch_assoc($check3);
    if(($row['Status']!=0) and $row2['Conduct']!=1){
?>
<form action="conduct.php" method="post">
    <center><input type="submit" class="btn btn-outline-info" value="Conduct Election"></center>
</form>
<?php
}
else if($row2['Conduct']!=0){
    $sql=$connect->query("select * from election where College_Name='$_SESSION[clgname]'");
    $rs=mysqli_fetch_assoc($sql);
    date_default_timezone_set('Asia/Kolkata');
    $today=date("Y-m-d");
    $time=date("H:i:s");
    $now=$today.$time;
    $result=$rs['Rdate'].$rs['Rtime'];
    if($now>=$result){
    echo "<center><a href='clgresult.php'><button class='btn btn-outline-success' >View Result</button></a></center><br><br>";
    echo "<center><a href='reset.php'><button class='btn btn-outline-danger' onclick='confirm(Are you sure? You want to reset everything?)' >Reset</button></a></center>";
}}
if(!$check2)
echo $connect->error;
}
?>
</body>
</html>