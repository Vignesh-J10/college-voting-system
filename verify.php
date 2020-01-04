<?php
//if activation code is set
if(isset($_GET['acode'])){
    //store the code and connect to db
    $acode=$_GET['acode'];
    include('dbconnect.php');
    //by defauult the code,fetch the respective user using acode
    $resultset=$connect->query("select Activation_Code,Mail_Status from clg where Mail_Status = 0 and Activation_Code='$acode' LIMIT 1");
    //if not verified already
    if($resultset->num_rows==1){
        //activation done
        $update=$connect->query("update clg set Mail_Status=1 where Activation_Code='$acode' Limit 1");
        if($update){
            echo "<br><br><br><br><br><center><h2>Your Account has been Verified</h2></center>";
            echo "<center><a href='login.html'><button type=submit name=register class='btn btn-success'>Login</button></a></center>";
        }
        //if any error occurs
        else{
            echo $connect->error;
        }
    }
    //if mail is already registered
    else{
        echo "<br><br><br><br><br><center><h2>This mail is invalid or already Registered</h2></center>";
        echo "<center><a href='index.html'><button type=submit name=register class='btn btn-success'>Back to Home</button></a></center>";
    }
}
//if anything goes wrong
else{
    die('something went wrong');
}
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
<link rel="stylesheet" href="style.css">
</head>
</html>