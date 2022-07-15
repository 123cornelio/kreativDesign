<?php

    require('php/conexao.php');
    $err ="";

    if(isset($_POST['send'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['senha']);

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // var_dump($passwordHash);
    $query = $con->prepare("SELECT * FROM users WHERE email = ?");
    $query->bindValue(1,$email);
    $query->execute();

    if($query->rowCount()){
        $err = "<p class='erro'>This email already exists!</p>";
    }else{
    try {
        $stm = $con->prepare("INSERT INTO users (nome,email,password) VALUES (?,?,?)");
        $stm->bindValue(1,$nome);
        $stm->bindValue(2,$email);
        $stm->bindValue(3,$passwordHash);
        $stm->execute();
        header("location: login.php");
    } catch (PDOException $e) {
        echo "Erro de conexao{$e->getMessage()}";
    }
    }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/sign.css">
    <title>Kreativ</title>
</head>
<body>
   
    <a href="index.php" class="logo"><img src="img/krea.png" alt=""></a>
    <div id="form-box">
        <form action="" method="POST" id="form">
            <h1><ico>A</ico>SIGN IN</h1>
            <div id="circle"></div>
            <?php echo $err; ?>
            <div class="row">
                <label><ico>A</ico>User Name</label>
                <input type="text" name="nome" id="nome" required>    
            </div>
            <div class="row">
                <label><ico>E</ico>Email </label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="row">
                <label><ico>L</ico>Password </label>
                <input type="password" name="senha" id="senha" required>    
            </div>
            
            <button type="submit" name="send">Send</button>
            <span class="desc">
                <p>Fill the fields to create an account and join us.</p>
                <p>If you already have an account click here to <a href="login.php  ">login</a></p>
            </span>
        </form>
    </div>
</body>
</html>