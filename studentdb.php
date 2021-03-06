<?php
include("dbconnect.php");
session_start();
$check=$connect->query("select Conduct from clg where College_Name='$_SESSION[clgname]'");
$row=mysqli_fetch_assoc($check);
    if($row['Conduct']!=1){
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
    $gotname=$_SESSION['clgname'];
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
<div class="input-row">
    <?php
    if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["name"];
    $fileTmpName=$_FILES["file"]["tmp_name"];
    $file_ext=pathinfo($fileName,PATHINFO_EXTENSION);
    $allowedType=array('csv');
    if(!in_array($file_ext,$allowedType)){
     ?>
     <div class="alert alert-danger">Invalid File Type!</div>
     <?php
    }
    else{
        $handle=fopen($fileTmpName,'r');
        while(($mydata=fgetcsv($handle,1000,','))!==FALSE){
            $regno=$mydata[0];
            $phn=$mydata[1];
            $db=$_SESSION['clgname'].'db';
            $create=$connect->query("create table $db(Regno varchar(30) primary key,Contact varchar(10))");
            $insert=$connect->query("insert into $db values('".$regno."','".$phn."')");
        }
        if(!$insert)
                echo $connect->error;
        else{
            $update=$connect->query("update clg set Conduct='1' where College_Name='$_SESSION[clgname]'");
            if(!$update)
            echo $connect->error;
            echo "<br><br><br>File Uploaded Successfully!";
            header('refresh:2;url=user.php');
        }
    }
}?>
    <form action="" method="post" enctype="multipart/form-data">
        <label class="col-md-4 control-label">Choose CSV File</label> <input
            type="file" name="file" id="file" accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
        <input type="submit" id="submit" name="import"
            class="btn-submit" value="Import">
        <br>
    </form>
    </div>
    <div id="labelError"></div><br>
    <?php
}
}
else{
    echo "<center><h2>You've already submitted the student database!</h2></center>";
}
?>
</body>
</html>