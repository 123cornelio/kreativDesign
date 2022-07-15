<?php

require("conexao.php");
session_start();    
if(isset($_SESSION['usuario'] )){
    $nome = $_SESSION["usuario"][0];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
    $id =$_GET['id'];
}else{
    header('location:login.php');
}


    $querySelect = $con->prepare("SELECT * FROM users WHERE id = ?");
    $querySelect->bindValue(1,$id);
    $querySelect->execute();
    $querySelect->rowCount();
    $result = $querySelect->fetch();
    $del_nome = $result['nome'];
    $del_email = $result['email'];


    $adm = 2;
    $query = $con->prepare('UPDATE users SET adm = ? WHERE id = ?');
    $query->bindValue(1,$adm);
    $query->bindValue(2,$id);

    if($query->execute()){
        $sql = $con->prepare("INSERT INTO relatorio (adm_nome, id_code,registro) VALUES (?,?,?)");
        $sql->bindValue(1,$nome);
        $sql->bindValue(2,$id_user);
        $sql->bindValue(3,'Updated <b>User</b>: '.$del_nome. ', <b>Email</b>: ' . $del_email);
        $sql->execute();
        header('location:../userAdm.php');
    }else{
        echo "fail";
    }


   

