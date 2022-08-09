
<?php
    error_reporting(E_ERROR | E_PARSE);
    require_once 'CheckAdmin.php';
          if(count($argv) == 3){
    
              $data = explode('=', $argv[1]);
              $user = $data[1];
            
              $data = explode('=', $argv[2]);
              $pass = $data[1];
    
              $status = CheckAdmin($user,$pass);
    
          }else if( isset($_SESSION["username"]) && isset($_SESSION["password"])){
              $status = CheckAdmin($_SESSION["username"],$_SESSION["password"]);
          }else{
            header("location:http://localhost/watch/admin/default/index.php");
          }

    function Connect(){
        include 'Settings.php';

		$request = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_NAME);

		if (!$request) {

			echo "Error: Unable to connect to MySQL." . PHP_EOL;

			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;

			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;

			exit;
		}
		
		return $request;
    }

    function close_db($request){
        mysqli_close($request);
    }
    
    function getAllOrderCount(){
    	$request = Connect();
    	$result = $request->query("call getAllOrdersCount()");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[count];
        return $data;
    }
    
    function getAllAccountsCount(){
        $request = Connect();
        $result = $request->query("call getAllAccountsCount()");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[count];
        return $data;
    }
    
    function getWaitingOrdersCount(){
        $request = Connect();
        $result = $request->query("call getWaitingOrdersCount()");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[count];
        return $data;
    }
    
    function getDoneOrdersCount(){
        $request = Connect();
        $result = $request->query("call getDoneOrdersCount()");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[count];
        return $data;
    }
    
    function getLimitedProduct($valueX,$valueY){
        $request = Connect();
        $result = $request->query("call getLimitedProduct($valueX,$valueY)");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[ProductName];
        return $data;
    }
    
    function getLimitedProductCount($valueX,$valueY){
        $request = Connect();
        $result = $request->query("call getLimitedProduct($valueX,$valueY)");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[ProductCount];
        return $data;
    }
    
    function getLimitedProductPrice($valueX,$valueY){
        $request = Connect();
        $result = $request->query("call getLimitedProduct($valueX,$valueY)");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[price];
        return $data;
    }
    
    function getOrdersActivityUserName($valueX,$valueY){
        $request = Connect();
        $result = $request->query("call getOrdersActivity($valueX,$valueY)");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[UserName];
        return $data;
    }
    
    function getOrdersActivityProductName($valueX,$valueY){
        $request = Connect();
        $result = $request->query("call getOrdersActivity($valueX,$valueY)");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[ProductName];
        return $data;
    }
    
    function getOrdersActivityOrderDate($valueX,$valueY){
        $request = Connect();
        $result = $request->query("call getOrdersActivity($valueX,$valueY)");
        $row = $result->fetch_assoc();
        close_db($request);
        $data = $row[OrderDate];
        return $data;
    }
?>
      <!DOCTYPE html>

<html lang="en">

<head>
    <title>Adminty - Premium Admin Template by Colorlib </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="..\admin\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\admin\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\css\jquery.mCustomScrollbar.css">
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="dashboard.php">
                            <img class="img-fluid" src="..\admin\files\assets\images\logo.png" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">

                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="..\admin\files\assets\images\avatar.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span><b><?php echo "Hello Admin"; ?></b></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="logout.php">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->
            
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="index.php">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="product.php">
                                        <span class="pcoded-micon"><i class="feather icon-package"></i></span>
                                        <span class="pcoded-mtext">Products</span>
                                    </a>
                                </li>
                            </ul>
    
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="order.php">
                                        <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                                        <span class="pcoded-mtext">Orders</span>
                                    </a>
    
                                </li>
                            </ul>
    
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="person.php">
                                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                                        <span class="pcoded-mtext">Person</span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="pages.php">
                                        <span class="pcoded-micon"><i class="feather icon-edit"></i></span>
                                        <span class="pcoded-mtext">Pages</span>
                                    </a>
                                </li>
                            </ul>
    
    
                        </div>
    
                        
                                
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                        <div class="row">
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-yellow update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">
                                                                    <?php echo getAllOrderCount();?>
                                                                </h4>
                                                                <h6 class="text-white m-b-0">All Orders</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-1" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update: <?php date_default_timezone_set('Europe/Berlin');  $date = date('h:i a', time());
                                                        echo $date; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">               
                                                                <?php echo getAllAccountsCount();?> 
                                                                
                                                                </h4>
                                                                <h6 class="text-white m-b-0">All Accounts</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-2" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update: <?php date_default_timezone_set('Europe/Berlin');  $date = date('h:i a', time());
                                                        echo $date; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-pink update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo getWaitingOrdersCount(); ?></h4>
                                                                <h6 class="text-white m-b-0">Waiting Orders</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-3" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update: <?php date_default_timezone_set('Europe/Berlin');  $date = date('h:i a', time());
                                                        echo $date; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo getDoneOrdersCount(); ?></h4>
                                                                <h6 class="text-white m-b-0">Done Orders</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update: <?php date_default_timezone_set('Europe/Berlin');  $date = date('h:i a', time());
                                                        echo $date; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->

                                            <!--  sale analytics start -->
                                            
                                            <!--  sale analytics end -->

                                            <div class="col-xl-8 col-md-12">
                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>Products in stock</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                                <li><i class="feather icon-trash-2 close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover  table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <div class="chk-option">
                                                                                <div class="checkbox-fade fade-in-primary">
                                                                                    <label class="check-task">
                                                                                        <input type="checkbox" value="">
                                                                                        <span class="cr">
                                                                                            <i class="cr-icon feather icon-check txt-default"></i>
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            Product</th>
                                                                        <th>Count</th>
                                                             
                                                                        <th>Price</th>
                                             
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="chk-option">
                                                                                <div class="checkbox-fade fade-in-primary">
                                                                                    <label class="check-task">
                                                                                        <input type="checkbox" value="">
                                                                                        <span class="cr">
                                                                                            <i class="cr-icon feather icon-check txt-default"></i>
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-inline-block align-middle">
                                                                                <h6><?php echo getLimitedProduct(0,1);?></h6>
                                                                                <p class="text-muted m-b-0">...</p>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo getLimitedProductCount(0,1);?></td>
                                        
                                                                        <td><?php echo getLimitedProductPrice(0,1);?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="chk-option">
                                                                                <div class="checkbox-fade fade-in-primary">
                                                                                    <label class="check-task">
                                                                                        <input type="checkbox" value="">
                                                                                        <span class="cr">
                                                                                            <i class="cr-icon feather icon-check txt-default"></i>
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-inline-block align-middle">
                                                                                <h6><?php echo getLimitedProduct(1,1);?></h6>
                                                                                <p class="text-muted m-b-0">...</p>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo getLimitedProductCount(1,1);?></td>
                                           
                                                                        <td><?php echo getLimitedProductPrice(1,1);?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="chk-option">
                                                                                <div class="checkbox-fade fade-in-primary">
                                                                                    <label class="check-task">
                                                                                        <input type="checkbox" value="">
                                                                                        <span class="cr">
                                                                                            <i class="cr-icon feather icon-check txt-default"></i>
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-inline-block align-middle">
                                                                                <h6><?php echo getLimitedProduct(2,1);?></h6>
                                                                                <p class="text-muted m-b-0">...</p>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo getLimitedProductCount(2,1);?></td>
                                                   
                                                                        <td><?php echo getLimitedProductPrice(2,1);?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="chk-option">
                                                                                <div class="checkbox-fade fade-in-primary">
                                                                                    <label class="check-task">
                                                                                        <input type="checkbox" value="">
                                                                                        <span class="cr">
                                                                                            <i class="cr-icon feather icon-check txt-default"></i>
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-inline-block align-middle">
                                                                                <h6><?php echo getLimitedProduct(3,1);?></h6>
                                                                                <p class="text-muted m-b-0">...</p>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo getLimitedProductCount(3,1);?></td>
                                                    
                                                                        <td><?php echo getLimitedProductPrice(3,1);?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="text-center">
                                                                <a href="https://amco.website/admin/product.php" class=" b-b-primary text-primary">View all products</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card user-activity-card">
                                                    <div class="card-header">
                                                        <h5>Orders Activity</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <img src="..\admin\files\assets\images\user-icon.png"  class="img-radius cover-img">
                                               </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?php  echo getOrdersActivityUserName(0,1);
                                                                ?></h6>
                                                                <p class="text-muted m-b-0"><?php echo
                                        getOrdersActivityProductName(0,1);
                                        ?></p>
                                                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i><?php echo
                                                                getOrdersActivityOrderDate(0,1);
                                                                ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <img src="..\admin\files\assets\images\user-icon.png" alt="user image" class="img-radius cover-img">
                                                  
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?php echo getOrdersActivityUserName(1,1);?></h6>
                                                                <p class="text-muted m-b-0"><?php echo getOrdersActivityProductName(1,1);?></p>
                                                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i><?php echo getOrdersActivityOrderDate(1,1);?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <img src="..\admin\files\assets\images\user-icon.png" alt="user image" class="img-radius cover-img">
                                               
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?php echo getOrdersActivityUserName(2,1);?></h6>
                                                                <p class="text-muted m-b-0"><?php echo getOrdersActivityProductName(2,1);?></p>
                                                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i><?php echo getOrdersActivityOrderDate(2,1);?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-5">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <img src="..\admin\files\assets\images\user-icon.png" alt="user image" class="img-radius cover-img">
                                             
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?php echo getOrdersActivityUserName(3,1);?></h6>
                                                                <p class="text-muted m-b-0"><?php echo getOrdersActivityProductName(3,1);?></p>
                                                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i><?php echo getOrdersActivityOrderDate(3,1);?></p>
                                                            </div>
                                                        </div>

                                                        <div class="text-center">
                                                            <a href="https://amco.website/admin/order.php" class="b-b-primary text-primary">View all orders</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="/files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="/files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="/files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="/files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="/files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script data-cfasync="false" src="..\admin\\\cdn-cgi\scripts\5c5dd728\cloudflare-static\email-decode.min.js"></script><script type="text/javascript" src="..\admin\files\bower_components\jquery\js\jque.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="..\admin\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="..\admin\files\bower_components\modernizr\js\modernizr.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="..\admin\files\bower_components\chart.js\js\Chart.js"></script>
    <!-- amchart js -->
    <script src="..\admin\files\assets\pages\widget\amchart\amcharts.js"></script>
    <script src="..\admin\files\assets\pages\widget\amchart\serial.js"></script>
    <script src="..\admin\files\assets\pages\widget\amchart\light.js"></script>
    <script src="..\admin\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="..\admin\files\assets\js\SmoothScroll.js"></script>
    <script src="..\admin\files\assets\js\pcoded.min.js"></script>
    <!-- custom js -->
    <script src="..\admin\files\assets\js\vartical-layout.min.js"></script>
    <script type="text/javascript" src="..\admin\files\assets\pages\dashboard\custom-dashboard.js"></script>
    <script type="text/javascript" src="..\admin\files\assets\js\script.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</body>

</html>