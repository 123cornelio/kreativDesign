<?php
require("php/conexao.php");

        $err = "";
        if(isset($_POST['send'])){
       if(isset($_POST['email']) && isset($_POST['senha']) && $con != null){
           $email = addslashes($_POST['email']);
           $password = addslashes($_POST['senha']);

           $query = $con->prepare("SELECT * FROM users WHERE email = ?");
           $query->execute(array($email));
           $result = $query->fetch(PDO::FETCH_ASSOC);

                if(password_verify($password, $result['password']) AND $query->rowCount()){
                    // $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];
                    session_start();
                    $_SESSION['usuario'] = array($result["nome"],$result["adm"],$result["id"]);
                    $nome = $_SESSION["usuario"][0];
                    $admin = $_SESSION["usuario"][1];
                    $id = $_SESSION['usuario'][2];

                    if($admin > 0){
                        header("location: adm.php");
                    }
                    else{
                        header("location: dashboard.php");
                    }
           }else{
            $err = "<p>Dados incorretos</p>";
           }
        }else{
            header("location: login.php");
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
            <h1><ico>A</ico>LOGIN</h1>
            <div id="circle"></div>
            <?php echo $err; ?>
            <div class="row">
                <label><ico>E</ico>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="row">
                <label><ico>L</ico>Password</label>
                <input type="password" name="senha" required>    
            </div>
            
            <button type="submit" name="send">Send</button>
            <span class="desc">
                <p>Fill the blank spaces correctly to log your account.</p>
                <p>haven't an account? <a href="signin.php">Signin</a></p>
            </span>
            
        </form>
    </div>
</body>
</html>
