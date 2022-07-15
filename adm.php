<?php

include_once("php/conexao.php");
  session_start();
  if(isset($_SESSION["usuario"]) && $_SESSION['usuario'][1] > 0){
    $nome = $_SESSION["usuario"][0];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
  }else{
    header('location: php/logout.php');
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <title>Kreativ <?php echo "/ {$nome}";?></title>
</head>
<body>

    <div id="all">
  <div class="side-bar">
    <div class="item selected">
      <a href="#"><div class="item-img"><img src="img/home.png"></div></a>
      <label>home</label>
  </div>
    <div class="item">
        <a href="user.php"><div class="item-img"><img src="img/user.png"></div></a>
        <label>users</label>
    </div>
    <div class="item">
        <a href="userAdm.php"><div class="item-img"><img src="img/adm.png"></div></a>
        <label>Admins</label>
    </div>
    <div class="item">
        <a href="ad_comment.php"><div class="item-img"><img src="img/comment.png"></div></a>
        <label>Comments</label>
    </div>
    <div class="item">
      <a href="ad_orders.php"><div class="item-img"><img src="img/order.png"></div></a>
      <label>Orders</label>
  </div>
    <div class="item">
        <a href="php/logout.php?code=1"><div class="item-img"><img src="img/logout.png"></div></a>
        <label>log out</label>
    </div>
    <div class="item">
        <a href="php/logout.php?code=2"><div class="item-img"><img src="img/signout.png"></div></a>
        <label>SignOut</label>
    </div>
  </div>
  <!-- main content -->

  <?php
  
      $stmt = $con->prepare("SELECT COUNT(*) as count FROM users WHERE adm = 0");
      $stmt->execute();
      $count = $stmt->fetch()["count"];

      $stmtadm = $con->prepare("SELECT COUNT(*) as count FROM users WHERE adm = 1");
      $stmtadm->execute();
      $countadm = $stmtadm->fetch()["count"];

      $stmtcom = $con->prepare("SELECT COUNT(*) as count FROM comment");
      $stmtcom->execute();
      $countcom = $stmtcom->fetch()["count"];

      $stmtcom = $con->prepare("SELECT COUNT(*) as count FROM orders");
      $stmtcom->execute();
      $countord = $stmtcom->fetch()["count"];
      
  ?>
  <div class="container">
      <div class="up-content">
        <div class="logo">
            <span class="logo-img"><img src="img/krea.png" alt=""></span>
        </div>
        <div class="adm-info">
        <span class="perfilImg"><img src="img/Perfil.png" alt=""><label>Perfil</label> <?php echo $nome;?></span>
        </div>
          <!-- Perfil view -->
      <!-- Perfil query catch -->
      <?php
        $sql = $con->prepare("SELECT * FROM users WHERE id =:id");
        $sql->bindValue("id",$id_user);
        $sql->execute();
        if($sql->rowCount()){
          $result_sql = $sql->fetch();
        }
      ?>
       <div class="perfilContainer">
         
        <div class="perfil">
        <span class="close"><img  class="closeImg" src="img/close.png" alt=""></span>
          <div class="per_top">
              <span class="per_img"><img src="img/perfilBig.png" alt=""></span>
              <span class="per_name"><n>Name:</n><br>#<?php echo $result_sql['nome'];?></span>
          </div>
          <div class="per_middle">
              <span class="per_inf"><n>id: </n>#<?php echo $result_sql['id'];?></span>
              <span class="per_inf"><n>email: </n><?php echo $result_sql['email'];?></span>
              <span class="per_inf"><n>date: </n><?php echo $result_sql['data_cadastro'];?></span>
          </div>
        </div>
        </div>


    <!-- End Perfil view -->
      </div>
      <div class="bottom-content">
          <span class="title">Kreativ Design</span>
          <div class="options">
              <a href="user.php" class="option">
                  <img src="img/user.png">
                  
                  <span class="info">
                  <h4>Users</h4>
                  </span>
                  <hr>
                
                <span class="total"> total: <?php echo $count;?></span>
              </a>
              <a href="userAdm.php" class="option">
                  <img src="img/adm.png">
                  <span class="info">
                  <h4>Admins</h4>
                  </span>
                  <hr>
                <span class="total"> total: <?php echo $countadm;?></span>
              </a>
              <a href="ad_comment.php" class="option">
                  <img src="img/comment.png">
                  <span class="info">
                  <h4>Comments</h4>
                  </span>
                  <hr>
                <span class="total"> total: <?php echo $countcom;?></span>
              </a>
              <a href="ad_orders.php" class="option">
                
                  <img src="img/order.png">
                  <span class="info">
                  <h4>Orders</h4>
                  </span>
                  <hr>
                <span class="total"> total: <?php echo $countord;?></span>                  
              </a>

          </div>

          <div class="relatorio">
            <?php 
              $query = $con->prepare("SELECT * FROM relatorio ORDER BY id DESC");
              $query->execute();
              
              if($query->rowCount()){
              
              while($result_query = $query->fetch()){
            ?>
            <div class="result">
              <h4 class="result_name"><?php echo '<ico>A </ico>'. $result_query['adm_nome'];?></h4>
              <p class="result_desc"><?php echo '<ico>J </ico>'.$result_query['registro'];?></p>
              <p class="result_date"><?php echo '<ico>T </ico>'.$result_query['data_registro'];?></p>
              <p class="result_delete"><?php 
                if($id_user == 1){
                  echo "<ico>R</ico>";
                }
                
                ?>
              </p>
            </div>
            <?php 
              }
            }
            ?>
          </div>
      </div>
  </div>
</div>
<script rel="javascript" src="js/script.js"></script>
</body>
</html>