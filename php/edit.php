<?php

require("conexao.php");
session_start();    
if(isset($_SESSION['usuario'] )){
    $nome = $_SESSION["usuario"][0];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
    // $id =$_GET['id'];
}else{
    header('location:../login.php');
}

    $nomeEdit = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $id = addslashes($_POST['id']);

    $querySelect = $con->prepare("SELECT * FROM users WHERE id = ?");
    $querySelect->bindValue(1,$id);
    $querySelect->execute();
    $querySelect->rowCount();
    $result = $querySelect->fetch();
    $del_nome = $result['nome'];
    $del_email = $result['email'];

    $query = $con->prepare('UPDATE users SET nome = ? , email = ?, password = ? WHERE id = ?');
    $query->bindValue(1,$nomeEdit);
    $query->bindValue(2,$email);
    $query->bindValue(4,$id);
    $query->bindValue(3,$passwordHash);

    if($query->execute()){
        $sql = $con->prepare("INSERT INTO relatorio (adm_nome, id_code,registro) VALUES (?,?,?)");
        $sql->bindValue(1,$nome);
        $sql->bindValue(2,$id_user);
        $sql->bindValue(3,'Edited <b>User</b>: '.$del_nome. ', <b>Email</b>: ' . $del_email);
        $sql->execute();
        header('location:../userAdm.php');
    }
    else{
        echo "fail";
    }