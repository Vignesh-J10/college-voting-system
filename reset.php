<?php
include('dbconnect.php');
session_start();
$sql=$connect->query("select * from election where College_Name='$_SESSION[clgname]'");
if(!$sql)
echo $connect->error;
$rs=mysqli_fetch_assoc($sql);
date_default_timezone_set('Asia/Kolkata');
$today=date("Y-m-d");
$result=$rs['Rdate'];
if($today>=$result){
$nextday=new DateTime($rs['Rdate']);
$nextday->modify("+1 day");
$nextday=$nextday->format("Y-m-d");
if($today>=$nextday){
    $selectpoll=$connect->query("select * from poll where College_Name='$_SESSION[clgname]'");
    while($row3=mysqli_fetch_assoc($selectpoll)){
        $table=$row3['Name'].$_SESSION['clgname'];
        $droppolltable=$connect->query("drop table $table");
        if(!$droppolltable)
        echo $connect->error;
    }
    $deletepolls=$connect->query("delete from poll where College_Name='$_SESSION[clgname]'");
    if($deletepolls){
        $table2='election'.$_SESSION['clgname'];
        $table3=$_SESSION['clgname'].'db';
        $dropelection=$connect->query("drop table $table2");
        $dropdb=$connect->query("drop table $table3");
        $deleteelectiontable=$connect->query("delete from election where College_Name='$_SESSION[clgname]'");
        $updatecon=$connect->query("update clg set Conduct='0' where College_Name='$_SESSION[clgname]'");
        if($updatecon)
        header("refresh:2;url=user.php");
    }
}
else
echo "You cant reset now! Come back on $nextday";
}
else
echo "The Result date is $rs[Rdate]";
?>