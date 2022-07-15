<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/gallery.css">
    <!-- <link rel="stylesheet" href="css/page.css"> -->

    <title>Gallery</title>
</head>
<body>
        <div id="nav-bar">
            <span class="nav-title">
                <h1>Kreativ Gallery</h1>
            </span>
            <div class="media">
                <div class="ln1"></div>
                <div class="ln2"></div>
                <div class="ln3"></div>
            </div>
            <span class="nav-menu">
                
                <ul class="list">
                    <a href="index.php"><li>HOME</li></a>
                    <a href="#!"><li>GALLERY</li></a>
                    <a href="login.php"><li>LOG IN</li></a>
                    <a href="dashboard.php"><li>CONTRATAR SERVIÇO</li></a>
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
                    <a href="dashboard.php"><li>CONTRATAR SERVIÇO</li></a>
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
        
        <!-- GALLERY SECTION-->
        <div class="gallery-container">
            <div class="gallery-content">
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
            </div>
            <div class="gallery-content">
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
            </div>
            <div class="gallery-content">
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
            </div>
            <div class="gallery-content">
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
            </div>
            <div class="gallery-content">
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
            </div>
            <div class="gallery-content">
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
                <div class="content"><div class="up-filter"></div></div>
            </div>
        </div>
      
        <!-- END GALLERY SECTION-->

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

    </script>
</body>
</html>



