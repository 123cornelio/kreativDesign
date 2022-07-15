<?php

require("php/conexao.php");
session_start();    
if(isset($_SESSION["usuario"]) && $_SESSION['usuario'][1] > 0){
    $id =$_GET['id'];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
}else{
    header('location:logout.php');
}
$query = $con->prepare("SELECT * FROM users WHERE id=?");
$query->bindValue(1,$id);

if($query->execute()){
    $result = $query->fetch();
    $nome = $result['nome'];
    $email = $result['email'];
    $password = $result['password'];
}else{
    header("location: user.php");
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
    <title>Edit User</title>
</head>
<body>
    <div class="edit">
    <form action="php/edit.php" method="post">
        <h1>Edit user</h1>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Name</label>
        <input type="text" name="nome" value="<?php echo $nome?>">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $email?>">
        <?php
            if($admin == 2 || $id == $id_user){
                echo "<label>New Password</label>";
                echo "<input type='password' name='password' value='$password'>";
                echo "<label>Confirm Password</label>";
                echo "<input type='password' name='password1' value=''>";
            }
        ?>
        <div class="btns">
            <?php
                if($admin == 2){
                    echo "<a href='php/action.php?id=$id' class='btn black'>Promote</a>";
                }
            ?>
        <a href="userAdm.php" class="btn red">Cancel</a>
        <?php
                if($admin == 2 || $id == $id_user){
                    echo "<button type='submit' class='btn blue'>Edit</button>";
                }else{
                    echo "<p class='erro'>You don't have permission to edit this user.</p>";
                }
                
            ?>
        </div>
    </form>
    </div>
</body>
</html>