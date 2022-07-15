<?php

include_once("php/conexao.php");
  session_start();
  $st = '';
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
    <title>Kreativ_Orders<?php echo "/ {$nome}";?></title>
</head>
<body>
    <div id="all">
  <div class="side-bar">
    <div class="item">
      <a href="adm.php"><span class="item-img"><img src="img/home.png"></span></a>
      <label>home</label>
  </div>
    <div class="item">
        <a href="user.php"><span class="item-img"><img src="img/user.png"></span></a>
        <label>users</label>
    </div>
    <div class="item">
        <a href="userAdm.php"><span class="item-img"><img src="img/adm.png"></span></a>
        <label>Admins</label>
    </div>
    <div class="item">
        <a href="ad_comment.php"><span class="item-img"><img src="img/comment.png"></span></a>
        <label>Comments</label>
    </div>
    <div class="item selected">
      <a href="#"><span class="item-img"><img src="img/order.png"></span></a>
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
  <div class="container">
      <div class="up-content">
        <div class="logo">
            <span class="logo-img"></span>
            <span class="name">Kreativ</span>
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
          <span class="title">Orders</span>

          <!-- SQL show all Orders -->
          <?php
          
          $query = $con->prepare("SELECT * FROM orders");          
          $query->execute();

          if($query->rowCount()){
            ?>
           <table>
             <thead class="color4">
                 <tr>
                   <th><ico>A </ico>Name</th>
                   <th><ico>T </ico>Order Date</th>
                   <th><ico>Q </ico>Status</th>
                   <th><ico>s </ico>Type</th>
                   <th><ico>i </ico>Actions</th>
                 </tr>
             </thead>
             <tbody>
             
               <?php
           while($result = $query->fetch()){
               ?>

               <?php 
               $status = $result['status'];
                if($status == 0){
                  $st = 'Available';
                }
                if($status == 1){
                  $st = 'Not available';
                }
               ?>
           <tr>
             <td><?php echo $result['nome']; ?></td>
             <td><?php echo $result['order_date']; ?></td>
             <td><?php echo $st; ?></td>
             <td><?php echo $result['tipo']; ?></td>
             <td class="action">
               <?php
               $id_job = $result['id'];
               $sql_order = $con->prepare("SELECT * FROM orders where id = $id_job");
               $sql_order->execute();
               $sql_order->rowCount();
               $result_order = $sql_order->fetch();
               $status_job = $result_order['status'];
                if($status_job == 1){
                  echo "<a href='vieworder.php?id=".$id_job."'><ico class='accepted'>O</ico></a>";
                  
                }
                else{
                  echo "<a href='vieworder.php?id=".$id_job."'  class='btn-link green'><img src='img/view.png'><label>view</label></a>";

                  echo "<form action='#' method='POST' class='delForm'>";
                  echo "<input type='hidden' name='id' value='" . $id = $result['id'] ."'>";
                  echo "<button type='submit' name='takeJob' class='btn-link avocadoGreen'><ico class='white'>w</ico><label>take_Job</label></button>";
                  echo "</form>";
                }
              ?>
             <?php
              if(isset($_POST['takeJob'])){
                $id = $_POST['id'];

                echo "<form action='php/takeJob.php' method='POST'>";
                echo "<div class='boxBg'>";
                echo "<div class='msgBox'>";
                echo "<h5>You want to take the job?</h5>";
                echo "<span class='btns'>";
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<button type='submit' name='takeJob' class='yesBtnB green'>YES</button>";
                echo "<a href='ad_orders.php' onclick='close()' class='noBtn'>NO</a>";
                echo "</span>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
              }
             ?>
            </td>
           </tr>
           
       </tbody>
       <?php } ?>

          </table>
           <?php }else{
             echo "<p>this Sections is empty. there are no orders yet.</div>";
           } ?>
  </div>
</div>
<script rel="javascript" src="js/script.js"></script>
</body>
</html>