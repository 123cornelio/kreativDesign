<?php
  include ("conexao.php");

  $comment = $_POST['comment'];
  $email = $_POST['email'];
  $name = $_POST['name'];
  $sect = $_GET['sect'];
  

  try {
    $stm = $con ->prepare("INSERT INTO comment (nome,email,comment) VALUES (?,?,?)");
    $stm->bindValue(1,$name);
    $stm->bindValue(2,$email);
    $stm->bindValue(3,$comment);
    $stm->execute();
    if($sect == 1){
      header("location: ../dashboard.php");
    }else{
    header("location: ../index.php");
    }
} catch (PDOException $e) {
    echo "Erro de conexao";
}
?>