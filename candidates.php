<?php
include('dbconnect.php');
session_start();
$gotname=$_SESSION['clgname'];
    if(isset($_POST['confirm'])){
        $update=$connect->query("update poll set Status='1' where Name='$_SESSION[pollalone]'");
        echo "<br><br><br><br><center><h2>Poll Submitted!</h2><br><a href='user.php'><button class='btn btn-success'>Back to Home</button></a></center>";
    }
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
        	<br><br><br>

<!--Candidate list-->
<center>
<div class="row">
<?php
if(isset($_POST['pollbtn'])){
    $poll=$_POST['pollbtn'];
    $_SESSION['pollalone']=$poll;
    $poll=$poll.$_SESSION['clgname'];
    $_SESSION['poll']=$poll;
    $check=$connect->query("select Name,Dept from $poll");
    if($check->num_rows!=0){
        while($result=mysqli_fetch_assoc($check)){
 ?>
  
 <div class="col-sm-3 col-6">
        <div class="card pollcard" style="width: 12rem;">
            <div class="card-body">
                <center>
                    <h2>
                <?php
                    echo $result['Name'];
                ?>
                </h2>
                <small><?php echo $result['Dept']?></small>
                </center>
            </div>
        </div>
    </div> 
    <?php
    }   
}
}}
if(isset($_POST['createpoll'])){
        $name=$_POST['name'];
        $dept=$_POST['dept'];
        $yr=$_POST['year'];
        $sql2=$connect->query("insert into $_SESSION[poll] values('$name','$dept','$yr')");
         $check=$connect->query("select Name,Dept from $_SESSION[poll]");
    if($check->num_rows!=0){
        while($result=mysqli_fetch_assoc($check)){
?>
 <div class="col-sm-3 col-6">
        <div class="card pollcard" style="width: 12rem;">
            <div class="card-body">
                <center>
                    <h2>
                <?php
                    echo $result['Name'];
                ?>
                </h2>
                <small><?php echo $result['Dept']?></small>
                </center>
            </div>
        </div>
    </div> 
    <?php }}}
    ?>
</div>
</center>
<!--Add Candidate-->
<?php
$status=$connect->query("select Status from poll where Name='$_SESSION[pollalone]' and College_Name='$_SESSION[clgname]' limit 1");
$status2=$connect->query("select * from $_SESSION[poll]");
$result=mysqli_fetch_assoc($status);
if($result['Status']!='1'){
?>
<center>
<br><br><br><br><br><br>
<form method="post" name="creation" action="">
<input type="text" name="name" placeholder="Enter the name of Candidate" id="t1"><br><br>
<input type="text" name="dept" placeholder="Enter the Department" id="t2"><br><br>
<label>Year</label>
<select name="year">
    <option>
        <li>I</li>
    </option>
    <option>
        <li>II</li>
    </option>
    <option>
        <li>III</li>
    </option>
    <option>
        <li>IV</li>
    </option>
    <option>
        <li>V</li>
    </option>
</select>
<br>
<input type="submit" class="btn btn-primary" name="createpoll" value="Add" id="s1">
<br>
</form>
<br>
<?php
if($status2->num_rows>1){
?>
<form action="" method="post">
<input type="submit" class="btn btn-primary" name="confirm" value="Finish Creation" id="s2">
</form>

<form action="deletecand.php" method="post">
    <input type="submit" class="btn btn-danger" name="delete" value="Delete Candidate">
</form>
</center>
<?php
}
}
?>
</html>