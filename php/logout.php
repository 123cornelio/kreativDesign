<?php
session_start();
session_destroy();

$code = $_GET['code'];

if($code == 1){
    header("location: ../login.php");
}else if($code == 2){
    header("location: ../index.php");
}else{
    header("location: ../login.php");
}
?>