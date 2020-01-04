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
include('dbconnect.php');
session_start();
if(isset($_SESSION['clgname'])){
    $gotname=$_SESSION['clgname'];
    echo '<br><br>';
if(isset($_POST['print'])){
        $sel=$connect->query("select Name from poll where (College_Name='$_SESSION[clgname]')");
        $table='election'.$_SESSION['clgname'];
        if($sel->num_rows!=0){
            while($row=mysqli_fetch_assoc($sel)){
                $poll=$row['Name'];
        $sql=$connect->query("select $poll poll,count($poll) cnt from $table where $poll is not null group by poll");
        if($sql->num_rows!=0){
        echo "<br><br><br><br><center><table border=5px cellpadding=10px style=text-align:center>
                <tr><th>Post</th><th>Winner</th><th>Votes</th></tr>";
        while($res=mysqli_fetch_assoc($sql)){
                echo "
                <tr><td>".$poll."</td><td>".$res['poll']."</td><td>".$res['cnt']."</td></tr>";
        }
        echo "</table></center>";
        }
            }
        }
            }
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
            <?php
}
            ?>