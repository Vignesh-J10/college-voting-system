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
session_start();
include('dbconnect.php');
if(isset($_SESSION['college'])){
    $gotname=$_SESSION['college'];
    echo "<br><br><br><br>";
$select=$connect->query("select Name from poll where (College_Name='$_SESSION[college]')");
if($select->num_rows!=0){
    echo "<div class='container'><div class='row'>";
    $table='election'.$_SESSION['college'];
    
    while($row=mysqli_fetch_assoc($select)){
        echo "<div class='col-sm-4'>";
        echo '<div class="card border-dark mb-3" style="max-width: 18rem;">';
        $poll=$row['Name'];
        $sql=$connect->query("select $poll poll,count($poll) cnt from $table where $poll is not null group by poll");
        $poll=strtoupper($poll);
        echo '<div class="card-header text-dark bg-primary"><center>'.$poll.'</center></div>
        <div class="card-body bg-primary text-dark">';
        $poll=strtolower($poll);
        if($sql->num_rows!=0){
            while($res=mysqli_fetch_assoc($sql))
            echo "<center><h4>$res[poll] has got $res[cnt] votes</h4></center>";
            $sql2=$connect->query("select $poll poll,count(*) count from $table where $poll is not null group by poll order by count Desc limit 1");
            while($row2=mysqli_fetch_assoc($sql2)){
                $pollname=$poll.$_SESSION['college'];
                $cand=$row2['poll'];
                $sql3=$connect->query("select Dept,Year from $pollname where (Name='$cand')");
                while($row3=mysqli_fetch_assoc($sql3))
                echo " <center>And your Winner is ".$row2['poll']."<br> Department: ".$row3['Dept']." Year:".$row3['Year']."</center>";
                echo "<br>";
            }
        }
        echo "</div></div></div>";
    }
    
    echo "</div></div>";
}
    if(!isset($_SESSION['college'])){
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
                      <a class='nav-item nav-link' href='index.html' id='clgname'>Home</a>
                      <a class='nav-item nav-link' href='complaint.html'>Report/Complaint</a>
                    </div>
                </div>
            </nav>
            <?php
        
    }
}
            ?>
        </body>
        </html>