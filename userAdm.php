<?php

  include_once("php/conexao.php");
  
  session_start();
  $err ="";
  $erro_admin = "";
  if(isset($_SESSION["usuario"]) && $_SESSION['usuario'][1] > 0){
    $nome = $_SESSION["usuario"][0];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
  }else{
    header('location: php/logout.php');
  }
  if(isset($_POST['add'])){
    if(isset($_POST['email']) && isset($_POST['senha']) && $con != null){
    
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['senha']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);


    
            //Verificaçao de admin

              $query = $con->prepare("SELECT * FROM users WHERE email = ?");
              $query->bindValue(1,$email);
              $query->execute();
              
              if($query->rowCount()){
                  $err = "<p class='erro'>This email already exists!</p>";
              }else{

              if($admin == 2){
                $query = $con->prepare("INSERT INTO users (nome, email,password,adm) VALUES (?,?,?,1)");
                $query->bindValue(1,$nome);
                $query->bindValue(2,$email);
                $query->bindValue(3,$passwordHash);
                $query->execute();
              }else{
                echo "<script>
                  alert ('You dont have the permission to add a new admin.');
              </script>";
              }
            }
            }else{
        header("location: userAdm.php");
        echo "<script>
                  alert('We had an error while trying to add new admin!');
              </script>";
    }
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
    <title>Kreativ<?php echo "/ {$nome}";?></title>
</head>
<body>

    <div id="all">
    <div class="modal">
              
              <form action="" method="POST" class="form-modal">
              <h2>Add a new Admin</h2>
              <ico class="btn-close">X</ico>
                <label><ico>A</ico> Name</label>
                <input type="text" name="nome" placeholder="type new user name" required>
                <label><ico>E</ico> Email</label>
                <input type="email" name="email" placeholder="type new user email" required>
                <label><ico>L</ico> Password</label>
                <input type="password" name="senha" placeholder="type new user password" required>
                <button type="submit" name="add">Add</button>
              </form>
            </div>
  <div class="side-bar">
    <div class="item">
      <a href="adm.php"><span class="item-img"><img src="img/home.png"></span></a>
      <label>home</label>
  </div>
    <div class="item">
        <a href="user.php"><span class="item-img"><img src="img/user.png"></span></a>
        <label>users</label>
    </div>
    <div class="item selected">
        <a href="userAdm.php"><span class="item-img"><img src="img/adm.png"></span></a>
        <label>Admins</label>
    </div>
    <div class="item">
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
            <span class="name">Users</span>
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
          <span class="title">Admins</span>
          

          <!--  -->
          <?php
          
          $query = $con->prepare("SELECT * FROM users WHERE adm = 1");          
          $query->execute();

          if($query->rowCount()){
            ?>
           <table>
             <thead class="color2">
                 <tr>
                   <th><ico>A </ico>Name</th>
                   <th><ico>E </ico>Email</th>
                   <th><ico>T </ico>Date of creation</th>
                   <th><ico>i </ico>Actions</th>
                 </tr>
             </thead>
             <tbody>
               <?php
           while($result = $query->fetch()){
               ?>
           <tr>
             <td><?php echo $result['nome']; ?></td>
             <td><?php echo $result['email']; ?></td>
             <td><?php echo $result['data_cadastro']; ?></td>
             <td class="action">
            <a href="editUser.php?id=<?php echo $result['id'];?>" class="btn-link green"><img src="img/edit.png"><label>edit</label></a>
             <!-- <div class="btn-link red del" onclick="action()"><img src="img/delete.png"><label>delete</label></div> -->

             <form action="#" method="POST" class="delForm">
                <input type="hidden" name="id" value="<?php echo $id = $result['id'];?>">
                <button type="submit" name="delete" class="btn-link red"><img src="img/delete.png"><label>delete</label></button>
             </form>

             <?php
              if(isset($_POST['delete'])){
                $id = $_POST['id'];
                
                if($admin==2){
                echo "<div class='boxBg'>";
                echo "<div class='msgBox'>";
                echo "<h5>Are you sure you want to permanently delete this user?</h5>";
                echo "<span class='btns'>";
                echo "<a href='php/deleteAdm.php?id=". $id."'"." class='yesBtn'>YES</a>";
                echo "<a href='userAdm.php' onclick='close()' class='noBtn'>NO</a>";
                echo "</span>";
                echo "</div>";
                echo "</div>";
                }else{
                  $erro_admin = "<p class='erro'>You don't have permission to delete any user.</p>";
                }
              }
             ?>
            </td>
           </tr>
       </tbody>
       <?php } ?>

          </table>
           <?php }else{
             echo "<p>this Sections is empty. there are no Admins yet.</div>";

           } ?>

            <div class="btn-add" name="btn-add">Add new Admin</div>
            <?php echo $err; ?>
            <?php echo $erro_admin;?>

            
          <!--  -->
      </div>
  </div>
</div>

<script rel="javascript" src="js/script.js"></script>
<script>
  let closeM = document.querySelector('.btn-close');
  let modal = document.querySelector('.modal');
  let btnAdd = document.querySelector('.btn-add');
  let activeBox = document.getElementsByClassName('del');
  let msgBox = document.querySelector('.boxBg');
  let closeMsg = document.getElementsByClassName('no');

  btnAdd.addEventListener("click",()=>{
    modal.classList.add("showModal");
  });

  closeM.addEventListener("click",()=>{
    modal.classList.remove("showModal");
  });
</script>
</body>
</html>