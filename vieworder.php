<?php

require("php/conexao.php");
session_start();    
if(isset($_SESSION["usuario"]) && $_SESSION['usuario'][1] > 0){
    $id =$_GET['id'];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
}else{
    header('location: php/logout.php');
}
$query = $con->prepare("SELECT * FROM orders WHERE id=?");
$query->bindValue(1,$id);



if($query->execute()){
    $result = $query->fetch();
    $nome = $result['nome'];
    $email = $result['email'];
    $date = $result['order_date'];
    $type = $result['tipo'];
    $contact = $result['contato'];
    $st = $result['status'];

        $status;

        if($st == 0){
            $status = "<p class='available'>Available</p>";

            $input = "<form action='#' method='POST' class='minForm'>
            <input type='hidden' name='id' value='" . $id."'>
            <button type='submit' name='takeJob' class='btn-linkq'><ico class='white'>w</ico></button>
            </form>";

        }else if($st == 1){
            $status = "<p class='notAvailable'>not available</p>";
            $input = "";
        }
      
        
    $description = $result['descricao'];
}else{
    header("location: ad_orders.php");
    echo "<script>
                alert('Fail on Delete!');
        </script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/edit.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit User</title>
</head>
<body>
    <div class="edit">
        <div class="order">
        <?php
              if(isset($_POST['takeJob'])){

                echo "<form action='php/takeJob.php' method='POST'>";
                echo "<div class='boxBg'>";
                echo "<div class='msgBox'>";
                echo "<h5>You want to take the job?</h5>";
                echo "<span class='btns'>";
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<button type='submit' name='takeJob' class='yesBtnB green'>YES</button>";
                echo "<a href='vieworder.php?id=$id' onclick='close()' class='noBtn'>NO</a>";
                echo "</span>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
              }
             ?>
            <a href="ad_orders.php" class="close"><ico>X</ico></a>
            <h2>Order Information</h2>
            <div class="client-info">
            <p><ico>A</ico>Name </p><span class="row"><?php echo $nome;?></span>
            <p><ico>E</ico>Email </p><span class="row"> <?php echo $email;?></span>
            <span class="row x"><?php echo $date;?></span>
            </div>
            <div class="order-info">
            <p><ico>Q</ico>Status </p> <span class="row"> <?php echo $status. $input;?></span>
            <p><ico>s</ico>Type </p> <span class="row c"><?php echo $type;?></span>
            <p><ico>b</ico>Description </p><span class="row c d"><?php echo $description;?></span>
            <p><ico>q</ico>Contact </p><span class="row c"><?php echo $contact;?></span>
            </div>
            
        </div>
        
    
    </div>
</body>
</html>