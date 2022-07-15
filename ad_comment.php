<?php

include_once("php/conexao.php");
  session_start();
  if(isset($_SESSION["usuario"]) && $_SESSION['usuario'][1] > 0){
    $nome = $_SESSION["usuario"][0];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
  }else{
    header('location:php/logout.php');
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
    <title>Kreativ_Comments <?php echo "/ {$nome}";?></title>
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
      <div class="item selected">
          <a href="ad_comment.php"><span class="item-img"><img src="img/comment.png"></span></a>
          <label>Comments</label>
      </div>
      <div class="item">
        <a href="ad_orders.php"><span class="item-img"><img src="img/order.png"></span></a>
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
            <span class="title">Comments</span>
          <!-- SQL show all Comments -->
          <?php
          
          $query = $con->prepare("SELECT * FROM comment");          
          $query->execute();

          if($query->rowCount()){
            ?>
           <table>
             <thead class="color3">
                 <tr>
                   <th><ico>A </ico>Name</th>
                   <th><ico>b </ico>Comment</th>
                   <th><ico>i </ico>Actions</th>
                 </tr>
             </thead>
             <tbody>
               <?php
           while($result = $query->fetch()){
               ?>
           <tr>
             <td><?php echo $result['nome']; ?></td>
             <td><?php echo $result['comment']; ?></td>
             <td class="action">
             <a href="" class="btn-link green"><img src="img/view.png"><label>view</label>
            </a>

            <form action="#" method="POST" class="delForm">
                <input type="hidden" name="id" value="<?php echo $id = $result['id'];?>">
                <button type="submit" name="delete" class="btn-link red"><img src="img/delete.png"><label>delete</label></button>
             </form>

             <?php
              if(isset($_POST['delete'])){
                $id = $_POST['id'];

                echo "<div class='boxBg'>";
                echo "<div class='msgBox'>";
                echo "<h5>Permanently delete this Comment?</h5>";
                echo "<span class='btns'>";
                echo "<a href='php/deleteComment.php?id=". $id."'"." class='yesBtn'>YES</a>";
                echo "<a href='ad_comment.php' onclick='close()' class='noBtn'>NO</a>";
                echo "</span>";
                echo "</div>";
                echo "</div>";
              }
             ?>
           </tr>
       </tbody>
       <?php } ?>

          </table>
           <?php }else{
             echo "<p>this Sections is empty. there are no orders yet.</div>";
           } ?>
        </div>
    </div>
  </div>
  <script rel="javascript" src="js/script.js"></script>
</body>
</html>