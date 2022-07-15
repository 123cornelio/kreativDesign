<?php

$server = "127.0.0.1";
$user = "root";
$pass = "";
$db = "kreativ";

try {
    $con = new PDO("mysql:host=$server;dbname=$db",$user,$pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    echo "Erro de conexao: {$erro->getMessage()}";
    $con = null;
}


