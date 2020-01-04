<?php
include('dbconnect.php');
session_start();
if(isset($_SESSION['clgname'])){
$gotname=$_SESSION['clgname'];
}
if(isset($_POST['conduct'])){
    $edate=$_POST['edate'];
    $etime=$_POST['etime'];
    $rdate=$_POST['rdate'];
    $rtime=$_POST['rtime'];
    if($edate>$rdate){
        echo "<br><br><br><center><h2>The result date must be after election date</h2></center>";
    }
    else{
    $sql=$connect->query("insert into election values('$_SESSION[clgname]','$edate','$etime','$rdate','$rtime')");
    if($sql){
        $select=$connect->query("select Name from poll where College_Name='$gotname'");
        $table=election.$gotname;
        $create=$connect->query("create table $table(Regno varchar(15) primary key)");
        if($select->num_rows!=0){
            while($row=mysqli_fetch_assoc($select)){
        $modifytable=$connect->query("alter table $table add($row[Name] varchar(20)) ");
        header("location:studentdb.php");
    }
}
else
echo "<br><br><br>".$connect->error;
}
else
echo "<br><br><br><center><h1> You have already submitted the election date and time!</h1></center>";
}
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
        		      <a class='nav-item nav-link' href='user.php' id='clgname'><?php echo $gotname?></a>
        		      <a class='nav-item nav-link' href='logout.php'>Logout</a>
        		    </div>
        	  	</div>
        	</nav>
        	<br><br><br>
<center>
    <form action="" method="post" name="uploadCSV">
        <div class="row">
            <div class="col-sm-6 col-6">
        <label>Enter Election Date: </label><br><input type="date" name="edate"><br>
        <label>Enter Election Time </label><small><i>(Format -- HH:MM AM/PM)</i></small><br><input type="time" name="etime"><br>
            </div>
            <div class="col-sm-6 col-6">
        <label>Enter Result Date: </label><br><input type="date" name="rdate"><br>
        <label>Enter Result Time </label><small><i>(Format -- HH:MM AM/PM)</i></small><br><input type="time" name="rtime"><br>
            </div>
            </div>
        <input type="submit" value="Conduct Election" name="conduct" class="btn btn-outline-success">
        
    </form>
</center>
	<?php
}
?>
<script type="text/javascript">
	$(document).ready(
	function() {
		$("#frmCSVImport").on(
		"submit",
		function() {

			$("#response").attr("class", "");
			$("#response").html("");
			var fileType = ".csv";
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
					+ fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
				$("#response").addClass("error");
				$("#response").addClass("display-block");
				$("#response").html(
						"Invalid File. Upload : <b>" + fileType
								+ "</b> Files.");
				return false;
			}
			return true;
		});
	});
</script>
</body>
</html>