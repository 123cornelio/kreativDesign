<?php
  include ("conexao.php");

  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $type = $_POST['type'];

  
  try {
    $stm = $con ->prepare("INSERT INTO orders (nome,email,contato,tipo,descricao) VALUES (?,?,?,?,?)");
    $stm->bindValue(1,$name);
    $stm->bindValue(2,$email);
    $stm->bindValue(3,$contact);
    $stm->bindValue(4,$type);
    $stm->bindValue(5,$description); ;
    if($stm->execute()){
      header("location: ../dashboard.php");
    }else{
    header("location: ../index.php");
    }
} catch (PDOException $e) {
    echo "Erro de conexao";
}
?>