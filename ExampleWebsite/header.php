<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
        <!--
        CSS
        ============================================= -->
        <link rel="stylesheet" href="css/linearicons.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/nice-select.css">					
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php 


function indexactive(){
    session_start(); 

    $login = false;
    if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
        $login = true;
    }
    if($login == 1){
    echo '
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <a href="index.php"><active>Home</active></a>
                    <a href="shop.php">Shop</a>
                    <a href="card.php">Card</a>
                    <a href="myorders.php">My Orders</a>
                    <a href="about.php">About</a>
                    <a href="logout.php">Logout</a>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header>';
    }else{
        echo '
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <a href="index.php"><active>Home</active></a>
                    <a href="shop.php">Shop</a>
                    <a href="login.php">Login</a>
                    <a href="about.php">About</a>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header>';
    }
}
function aboutactive(){
    session_start(); 

    $login = false;
    if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
        $login = true;
    }
    if($login == 1){
    echo '
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <a href="index.php">Home</a>
                    <a href="shop.php">Shop</a>
                    <a href="card.php">Card</a>
                    <a href="myorders.php">My Orders</a>
                    <a href="about.php"><active>About</active></a>
                    <a href="logout.php">Logout</a>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header>';
    }else{
        echo '
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <a href="index.php">Home</a>
                    <a href="shop.php">Shop</a>
                    <a href="login.php">Login</a>
                    <a href="about.php"><active>About</active></a>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header>';
    }
}

function shopactive(){
    session_start(); 

    $login = false;
    if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
        $login = true;
    }
    if($login == 1){
    echo '
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <a href="index.php">Home</a>
                    <a href="shop.php"><active>Shop</active></a>
                    <a href="card.php">Card</a>
                    <a href="myorders.php">My Orders</a>
                    <a href="about.php">About</a>
                    <a href="logout.php">Logout</a>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header>';
    }else{
        echo '
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <a href="index.php">Home</a>
                    <a href="shop.php"><active>Shop</active></a>
                        <a href="login.php">Login</a>
                    <a href="about.php">About</a>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header>';
    }
}function loginactive(){
    session_start(); 

    $login = false;
    if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
        $login = true;
    }
    if($login == 1){
    echo '
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <a href="index.php">Home</a>
                    <a href="shop.php">Shop</a>
                    <a href="card.php">Card</a>
                    <a href="myorders.php">My Orders</a>
                    <a href="about.php">About</a>
                    <a href="logout.php">Logout</a>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header>';
    }else{
        echo '
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <a href="index.php">Home</a>
                    <a href="shop.php">Shop</a>
                        <a href="login.php"><active>Login</active></a>
                    <a href="about.php">About</a>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </header>';
    }
}
    function cardactive(){
        session_start(); 
    
        $login = false;
        if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
            $login = true;
        }
        if($login == 1){
        echo '
            <header id="header" id="home">
                <div class="container">
                    <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                        <a href="index.php">Home</a>
                        <a href="shop.php">Shop</a>
                        <a href="card.php"><active>Card</active></a>
                        <a href="myorders.php">My Orders</a>
                        <a href="about.php">About</a>
                        <a href="logout.php">Logout</a>
                        </ul>
                    </nav><!-- #nav-menu-container -->		    		
                    </div>
                </div>
            </header>';
        }
    }
    function myordersactive(){
        session_start(); 
    
        $login = false;
        if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
            $login = true;
        }
        if($login == 1){
        echo '
            <header id="header" id="home">
                <div class="container">
                    <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                        <a href="index.php">Home</a>
                        <a href="shop.php">Shop</a>
                        <a href="card.php">Card</a>
                        <a href="myorders.php"></active>My Orders</active></a>
                        <a href="about.php">About</a>
                        <a href="logout.php">Logout</a>
                        </ul>
                    </nav><!-- #nav-menu-container -->		    		
                    </div>
                </div>
            </header>';
        }
    }
   ?>



            <script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>			
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>			
			<script src="js/parallax.min.js"></script>	
			<script src="js/mail-script.js"></script>	
			<script src="js/maincode.js"></script>	

</body>