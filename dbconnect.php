<?php
$connect = mysqli_connect('localhost', 'collegev_viki', 'viki007', 'collegev_vote');
if(!$connect){
    echo "Db error";
}
?>