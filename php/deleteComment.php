<?php        

require("conexao.php");
session_start();    
if(isset($_SESSION['usuario'] )){
    $nome = $_SESSION["usuario"][0];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
    $id =$_GET['id'];
}else{
    header('location: ../login.php');
}

$querySelect = $con->prepare("SELECT * FROM comment WHERE id = ?");
$querySelect->bindValue(1,$id);
$querySelect->execute();
$querySelect->rowCount();
$result = $querySelect->fetch();
$del_nome = $result['nome'];
$del_email = $result['email'];


$query = $con->prepare("DELETE FROM comment WHERE id = ?");
$query->bindValue(1,$id);


if($query->execute()){
    $sql = $con->prepare("INSERT INTO relatorio (adm_nome, id_code,registro) VALUES (?,?,?)");
        $sql->bindValue(1,$nome);
        $sql->bindValue(2,$id_user);
        $sql->bindValue(3,'Deleted '.$del_nome. '`s  comment'. ', <b>Email</b>: ' . $del_email);
        $sql->execute();
    header("location: ../ad_comment.php");
    echo "deleted";
}else{
    header("location: ../ad_comment.php");
}