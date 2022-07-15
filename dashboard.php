<?php

require_once('php/conexao.php');
session_start();
if(isset($_SESSION["usuario"])){
    $nome = $_SESSION["usuario"][0];
    $admin = $_SESSION["usuario"][1];
    $id_user = $_SESSION["usuario"][2];
  }else{
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/dash.css">

    <title>Dashboard</title>
</head>
<body>
<div id="nav-bar">
            <span class="nav-title">
                <h1>DashBoard</h1>
                <div class="gadgets"></div>
            </span>
            <?php echo "<adm>Usuario: ".$nome."</adm>";?>
            <div class="media">
                <div class="ln1"></div>
                <div class="ln2"></div>
                <div class="ln3"></div>
            </div>
            
            <span class="nav-menu">
                
                <ul class="list">
                    <a href="index.php"><li>HOME</li></a>
                    <a href="gallery.php"><li>GALLERY</li></a>
                    <a href="login.php"><li>LOG IN</li></a>
                    <a href="#service"><li>CONTRATAR SERVIÇO</li></a>
                </ul>
            </span>
        </div>
                <!--  -->
        <div id="header">
        <span class="nav-menu-mobile hide-mobile">
                
                <ul class="list">
                    <a href="index.php"><li>HOME</li></a>
                    <a href="gallery.php"><li>GALLERY</li></a>
                    <a href="login.php"><li>LOG IN</li></a>
                    <a href="#service"><li>CONTRATAR SERVIÇO</li></a>
                </ul>
        </span>
            <div id="welcome">
                <span class="wel-title">
                    <!-- <h2>“Design é onde ciência e arte se equilibram.”</h2> -->
                </span>
                <span class="wel-desc">
                    <p></p>
                </span>
                
            </div>
        </div>
                        <!-- --------------------------------------------- -->
                        <!--                  MAIN SECTION                 -->
                        <!-- --------------------------------------------- -->
      <section class="main-section">
        <!-- OPERATIONS SECTION-->
        <div class="operation-container">
            <div class="operation-content">
                <h2>Send us your comment, your Sugestion metter for us!</h2>
                <?php 
                    $sql = $con->prepare("SELECT * FROM users WHERE id = $id_user");
                    $sql->execute();

                    if($sql->rowCount()){
                    $result = $sql->fetch();
                    }?>
                <form action="php/comment.php?sect=1" method="POST" class="form">
                    <input type="hidden" name ="name" value="<?php echo $result['nome'];?>">
                    <input type="hidden" name ="email" value="<?php echo $result['email'];?>">
                    <label class="blue">Comment</label>
                    <input type="text" class="comment" name="comment" placeholder="type your comment or sugestion" required>
                    <button type="submit">SEND</button>
                </form>
            </div>
            <div class="design-content">
                <div class="design-item">
                    <span class="item-img logos">
                        
                    </span>
                    <span class="item-desc">
                        <h3>Logo</h3>
                        <p>Desenvolvemos e criamos um coinceito de acordo com as necessidades da marca.</p>
                    </span>
                    <button><img  class="order-img" src="img/order_white.png"> ORDER </button>
                </div>
                <div class="design-item">
                    <span class="item-img decoracao">
                        
                    </span>
                    <span class="item-desc">
                        <h3>Decoração</h3>
                        <p>Deixe o ambiente mais aconchegante e esteticamente lindo.</p>
                    </span>
                    <button><img  class="order-img" src="img/order_white.png"> ORDER </button>
                </div>
                <div class="design-item">
                    <span class="item-img flyer">
                    </span>
                    <span class="item-desc">
                        <h3>Flyer</h3>
                        <p>Acreditamos que é necessario arriscar, de modo a atingir novas oportunidades</p>
                    </span>
                    <button><img  class="order-img" src="img/order_white.png"> ORDER </button>
                </div>
            </div>
            <div class="operation-content" id="service">
                <h2>Contact us to satisfy your wish.</h2>
                <form action="php/order.php" method="POST" class="form">
                    <input type="hidden" name ="name" value="<?php echo $result['nome'];?>">
                    <input type="hidden" name ="email" value="<?php echo $result['email'];?>">
                    <label>Contact</label>
                    <input type="text" name="contact" placeholder="Whatsaap or Phone number only..." required>
                    <label>Select the Type</label>
                    <select name="type" class="select" required>
                        <option></option>
                        <option>Logotipo</option>
                        <option>Banner</option>
                        <option>Flyer</option>
                        <option>Web Site</option>
                        <option>Visit Card</option>
                        <option>Quadros Personalizados</option>
                        <option>Decoração</option>
                        <option>Web Application</option>
                        <option>Social Media</option>
                    </select>
                    <label>Descrition of  the order..</label>
                    <input type="text" name="description" placeholder="Describe what you wish, and we help you." required>
                    <button type="submit">ORDER</button>
                </form>
            </div>
            <div class="design-content">
                <div class="design-item">
                    <span class="item-img website">
                        
                    </span>
                    <span class="item-desc">
                        <h3>Website</h3>
                        <p>Criação de Interfaces coerente com sua Identidade Visual. Veja nosso serviço de criação de layout.</p>
                    </span>
                    <button><img  class="order-img" src="img/order_white.png"> ORDER </button>
                </div>
                <div class="design-item">
                    <span class="item-img card">
                        
                    </span>
                    <span class="item-desc">
                        <h3>Cards</h3>
                        <p>Todos os elementos da tua marca são fundamentais e únicos.</p>
                    </span>
                    <button><img  class="order-img" src="img/order_white.png">ORDER</button>
                </div>
                <div class="design-item">
                    <span class="item-img social">
                        
                    </span>
                    <span class="item-desc">
                        <h3>Social Media</h3>
                        <p>Apartir das redes socias tenha maior contacto com o publico, atraindo assim mais clientes.</p>
                    </span>
                    <button><img  class="order-img" src="img/order_white.png">ORDER</button>
                </div>
                
            </div>
        </div>
        <!-- END OPERATIONS SECTION-->

        <!-- MOre SECTION-->
        <div class="more-container">
        <div class="slider"> 
            <!-- picture 01 -->
            <div class="slide active-slide">
                    <img src="img02/logo01.png"> 
            </div>
            <!-- picture 02 -->
            <div class="slide">
                    <img src="img02/logo02.png"> 
            </div>
            <!-- picture 03 -->
            <div class="slide">
                    <img src="img02/logo03.png">
            </div>
            <!-- picture 04 -->
            <div class="slide">
                    <img src="img02/logo04.png">
            </div>
            <div class="slide">
                    <img src="img/krea.png">
            </div>
        </div>
        <div class="slider"> 
            <!-- picture 01 -->
            <div class="slideCard active-slide">
                    <img src="img02/card01.jpg"> 
            </div>
            <!-- picture 02 -->
            <div class="slideCard">
                    <img src="img02/card02.jpg"> 
            </div>
            <!-- picture 03 -->
            <div class="slideCard">
                    <img src="img02/card03.jpg">
            </div>
            <!-- picture 04 -->
            <div class="slideCard">
                    <img src="img02/card04.png">
            </div>
            <div class="slideCard">
                    <img src="img02/ft03.png">
            </div>
        </div>
        <div class="slider"> 
            <!-- picture 01 -->
            <div class="slideFlyer active-slide">
                    <img src="img02/flyer01.png"> 
            </div>
            <!-- picture 02 -->
            <div class="slideFlyer">
                    <img src="img02/flyer02.png"> 
            </div>
            <!-- picture 03 -->
            <div class="slideFlyer">
                    <img src="img02/flyer03.png">
            </div>
            <!-- picture 04 -->
            <div class="slideFlyer">
                    <img src="img02/flyer04.png">
            </div>
            <div class="slideFlyer">
                    <img src="img02/flyer05.png">
            </div>
        </div>
           
        </div>
        
        <!-- END OPERATIONS SECTION-->

        </section>

        <footer>
            <div class="f-content">
            <h3>Serviços</h3>
            <div class="cnt-item">
            <a href="dashboard.php" >Design Gráfico</a>            
            <a href="dashboard.php">Web Design</a>            
            <a href="dashboard.php">Social media</a>            
            <a href="dashboard.php">Branding</a>      
            </div>      
            </div>

            <div class="f-content">
            <h3>Design Gráfico</h3>
            <div class="cnt-item">
            <a href="dashboard.php">Logotipos</a>            
            <a href="dashboard.php">Banners</a>            
            <a href="dashboard.php">Cartap de visita</a>            
            <a href="dashboard.php">Flyers</a> 
            </div>           
            </div>

            <div class="f-info">
            <span>kreative art Design, Design Agence</span>
            <span>Last update, april 2022</span>           
            </div>
        </footer>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
        let lines = document.querySelectorAll('.line');
        let media = document.querySelector('.media');
        let mobile = document.querySelector('.hide-mobile');
        let line1 = document.querySelector('.ln1');
        let line3 = document.querySelector('.ln3');
        let line2 = document.querySelector('.ln2');

        media.addEventListener('click',()=>{
            line1.classList.toggle('line1');
            line2.classList.toggle('line2');
            line3.classList.toggle('line3');
            mobile.classList.toggle("show-mobile");

        });

        var slideSpeed = 4000;

        var main = function(){
            //Carousel
        setInterval(function() {timedDelay()}, slideSpeed);
        };

        //timedDelay function
        function timedDelay() { 
        var currentSlide = $('.active-slide');
            var nextTimedSlide = currentSlide.next();
            var nextSlide = currentSlide.next();
            var nextSlideFlyer = currentSlide.next();
            
        if(nextTimedSlide.length === 0 ) {
                nextTimedSlide = $('.slide').first();
                nextSlide = $('.slideCard').first();
                nextSlideFlyer = $('.slideFlyer').first();
            }
        
            currentSlide.fadeOut(400, function() {
                $(this).removeClass('active-slide');
            nextTimedSlide.fadeIn(400).addClass('active-slide');
            nextSlide.fadeIn(400).addClass('active-slide');
            nextSlideFlyer.fadeIn(400).addClass('active-slide');
                });
        }
        

$(document).ready(main);
    


    </script>
</body>
</html>



