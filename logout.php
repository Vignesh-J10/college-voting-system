<?php
session_start();
session_unset();
session_destroy();
setcookie('otp',"",time()-3600);
header("location:index.html");
exit();
?>