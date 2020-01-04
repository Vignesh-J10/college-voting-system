<?php
include('dbconnect.php');
session_start();
if(isset($_POST['vote'])){
    $candidate=$_POST['vote'];
    $table='election'.$_SESSION['college'];
    $poll=$_SESSION['pollname'];
    $select=$connect->query("select $_SESSION[pollname] from $table where (Regno='$_SESSION[regno]' and $_SESSION[pollname] is null)");
    if($select->num_rows==0){
        echo "<br><br><br><br><center><h2>You have already casted your vote for $poll!</h2></center>";
        header("refresh:2,url=castvote.php");
    }
    else{
    $update=$connect->query("update $table set $_SESSION[pollname]='$candidate' where (Regno='$_SESSION[regno]' and $_SESSION[pollname] is null)");
    if(!$update)
        echo $connect->error;
    else
        echo "<br><br><br><br><center><h2>Vote Casted on $_SESSION[pollname] for $candidate</h2></center>";
        header("refresh:2,url=castvote.php");
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
<body>
    <nav class='navbar navbar-expand-lg navbar-light bg-warning fixed-top'>
                    <a class='navbar-brand'>College Voting System</a>
                    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
                        <span class='navbar-toggler-icon'></span>
                    </button>
                <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
                    <div class='navbar-nav ml-auto'>
                      <a class='nav-item nav-link' href='complaint.html'>Report/Complaint</a>                      
                    </div>
                </div>
            </nav>
            </body>
            </html>