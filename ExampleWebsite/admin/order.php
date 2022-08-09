
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
        header("location:index.php");
      }

?>
<?php
    include getcwd().'/src/DatabaseOperation.php';

    if(  !is_null($_POST["ChangeButton"] )){
        $OrderID = $_POST["ChangeOrderID"];
        $OrderStatus = $_POST["ChangeStatus"];

        $result = updateOrderStatus($OrderID,$OrderStatus);

        if($result == 1){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Updated!")';
            echo '</script>';
        }
    }

    if(  !is_null($_POST["Remove"] )){

        $OrderID = $_POST["removeOrderID"];
       
        $result = removeOrder($OrderID);

        if($result == 1){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Removed!")';
            echo '</script>';
        }
    }

    if(  !is_null($_POST["FormEdit"] || !is_null($_POST["FormAdd"])  )){
        
        if(  !is_null($_POST["FormEdit"])){
            $Data = GetUser($_POST["EditOrderID"]);
        }

        $EditPersonID = "";
        $EditAmount = "";
        $EditAddress= "";
        $EditProductID="";

        if(!is_null($_POST["EditPersonID"])){
            $EditPersonID = $_POST["EditPersonID"];
        }else if(  !is_null($_POST["FormEdit"]))
        {
            $EditPersonID = $Data[UserID];
        }
        if(!is_null($_POST["EditAmount"])){
            $EditAmount = $_POST["EditAmount"];
        }else if(  !is_null($_POST["FormEdit"]))
        {
            $EditAmount = $Data[OrderCount];
        }
        
        if(!is_null($_POST["EditAddress"])){
            $EditAddress = $_POST["EditAddress"];
        }else if(  !is_null($_POST["FormEdit"]))
        {
            $EditAddress = $Data[address];
        } 
        
        if(!is_null($_POST["EditProductID"])){
            $EditProductID = $_POST["EditProductID"];
        }else if(  !is_null($_POST["FormEdit"]))
        {
            $EditProductID = $Data[ProductID];
        }



        if(  !is_null($_POST["FormEdit"])){
            $result = UpdateOrder($EditPersonID,$_POST["EditOrderID"],$EditProductID,$EditAmount,$EditAddress);
        }else if( !is_null($_POST["FormAdd"])){
            $result = PushOrder($EditProductID,$EditPersonID,$EditAmount,$EditAddress);
        }

        if($result == 1){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Updated!")';
            echo '</script>';
        }
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
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\admin\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\icon\themify-icons\themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\icon\feather\css\feather.css">
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\pages\j-pro\css\demo.css">
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\pages\j-pro\css\font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="..\admin\files\assets\pages\j-pro\css\j-pro-modern.css">
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
                            <li class="">
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
                            <li class="active">
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
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>Orders</h4>
                                                    <span>You can show all your products and their features.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Orders</a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->
                                    
                                    <!-- Page body start -->

                                    <div class="page-body">
  
                                        <!-- Table header styling table start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Table Header Styling</h5>
                                                <span>use class <code>table-primary, table-*</code> inside thead tr element</span>

                                            </div>
                                            <form method="post">
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-styling">
                                                        <thead>
                                                            <tr class="table-primary">
                                                                <th>
                                                                    <select name="PageSelect" onchange="this.form.submit()">
                                                                        <?php
                                                                                
                                                                                $TotalCount=GetAllOrdersCount();
                                                                                $TotalPage = ceil($TotalCount / 10.0);
                                                                                
                                                                                if(!is_null($_POST["PageSelect"])){
                                                                                    $page = $_POST["PageSelect"];
                                                                                }else{
                                                                                    $page = 1;
                                                                                }
                                                                                echo'<option value="">Page</option>';
                                                                                for($i=1;$i<=$TotalPage;$i++){
                                                                                    if($page == $i){
                                                                                        echo'<option value="'.$i.'">#'.$i.'</option>';
                                                                                    }else{
                                                                                        echo'<option value="'.$i.'">'.$i.'</option>';
                                                                                    }
                                                                                }
                                                                                 
                                                                        ?>
                                                                </th>
                                                                <th>OrderID</th>
                                                                <th>User Name</th>
                                                                <th>Product Name</th>
                                                                <th>Amount</th>
                                                                <th>One Product Price</th>
                                                                <th>Total Cost</th>
                                                                <th>Address</th>
                                                                <th>Order Status</th>
                                                                <th>Created Date</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        if($page == 1){
                                                            $Pages = GetLimitOrders(0,10);
                                                        }else{
                                                            $Pages = GetLimitOrders( ( ($page-1)*10)-1,10);
                                                        }
                                                        $x=($page-1)*10;
                                                        while($row = $Pages->fetch_assoc()) {
                                                            switch($row[ordersStatus]){
                                                                case 0: $status = '<font color ="#20A0E9">applied</font>'; 	break;
                                                                case 1: $status = '<font color ="#2051E9">approved</font>'; 	break;
                                                                case 2: $status = '<font color ="#E92020">rejected</font>'; 	break;
                                                                case 3: $status = '<font color ="#20E9A9">completed</font>'; 	break;
                                                            }
                                                            echo'
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">'.$x.'</th>
                                                                        <td>'.$row[OrderID].'</td>
                                                                        <td>'.$row[UserName].'</td>
                                                                        <td>'.$row[ProductName].'</td>
                                                                        <td>'.$row[OrderCount].'</td>
                                                                        <td>'.$row[price].'</td>
                                                                        <td>'.($row[OrderCount]*$row[price]).'</td>
                                                                        <td>'.$row[address].'</td>
                                                                        <td>'.$status.'</td>
                                                                        <td>'.$row[OrderDate].'</td>
                                                                    </tr>
                                                                </tbody>
                                                            ';
                                                            $x++;
                                                        }
                                                    ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                        <!-- Table header styling table end -->
                                    </div>

                                    



                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Adding or Editing Order</h5>
                                                        <span>if the product already has,the system will edit else system add new item</span>

                                                    </div>
                                                    <div class="card-block">
                                                        <div class="j-wrapper j-wrapper-640">
                                                            <form method="post" class="j-pro" novalidate="">
                                                                <div class="j-content">
                                                                    <!-- start name -->
                                                                    <div class="j-unit">
                                                                        <label class="j-label">Order ID</label>
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="ProductName"><i class="icofont icofont-package"></i> </label>
                                                                            <input type="text" placeholder="if you want add new order,you shouldn't fill" name="EditOrderID">
                                                                        </div>
                                                                    </div>
                                                                

                                                                    <div class="j-divider j-gap-bottom-25"></div>

                                                                    <div class="j-unit">
                                                                    <label class="j-label">Person</label>
                                                                    <label class="j-input j-select">
                                                                        <select name="EditPersonID">
                                                                            <option value="" selected="">Choose your person</option>
                                                                            <?php
                                                                            $Pages = GetAllAccounts();
                                                                            while($row = $Pages->fetch_assoc()) {
                                                                                    echo'
                                                                                    <option value="'.$row[UserID].'">'.$row[UserName].'</option>
                                                                                    ';
                                                                                }
                                                                            ?>
                                                                            </select>
                                                                            <i></i>
                                                                        </label>
                                                                    </div>
                                                                    
                                                                    <div class="j-unit">
                                                                    <label class="j-label">Product</label>
                                                                    <label class="j-input j-select">
                                                                        <select name="EditProductID">
                                                                            <option value="" selected="">Choose your person</option>
                                                                            <?php
                                                                            $Pages = GetProducts();
                                                                            while($row = $Pages->fetch_assoc()) {
                                                                                    echo'
                                                                                    <option value="'.$row[ProductID].'">'.$row[ProductName].'</option>
                                                                                    ';
                                                                                }
                                                                            ?>
                                                                            </select>
                                                                            <i></i>
                                                                        </label>
                                                                    </div>

                                                                                
                                                                    <!-- end name -->
                                                                    <!-- start email phone -->
                                                                    <div class="j-unit">
                                                                        <label class="j-label">Amount</label>
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="ProductName"><i class="icofont icofont-package"></i> </label>
                                                                            <input type="text" placeholder="if you want add new order,you shouldn't fill" name="EditAmount">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    

                                                                    <!-- end email phone -->
                                                                    <div class="j-divider j-gap-bottom-25"></div>
                                                                   
                                                                    <!-- start message -->
                                                                    <div class="j-unit">
                                                                        <label class="j-label">Address</label>
                                                                        <div class="j-input">
                                                                            <textarea spellcheck="false" name="EditAddress"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end message -->
                                                                    <!-- start response from server -->
                                                                    <div class="j-response"></div>
                                                                    <!-- end response from server -->
                                                                    

                                                                </div>
                                                                
                                                                
                                                                <!-- end /.content -->
                                                                <div class="j-footer">
                                                                    <div class="j-span6">
                                                                        <button type="submit" style="margin-left:10;" name="FormAdd" id="" class="btn btn-primary">Add</button>
                                                                    </div>
                                                                    <div class="j-span2">
                                                                        <button type="submit" style="margin-left:10;" name="FormEdit" id="" class="btn btn-primary">Edit</button> 
                                                                    </diV>
                                                                </div>
                                                                <!-- end /.footer -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Ready suggestion card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Change Your Order Status</h5>
                                                        <span>If you want change one product status,you only must do select item and status </span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="j-wrapper j-wrapper-640">
                                                            <form method="post" class="j-pro" novalidate="">
                                                                <!-- end /.header-->
                                                                <div class="j-content">
                                                                    <div class="j-unit">
                                                                        <label class="j-input j-select">
                                                                            <select name="ChangeOrderID">
                                                                                <option value="" selected="">Choose your person</option>
                                                                                <?php
                                                                                    if($page == 1){
                                                                                        $Pages = GetLimitOrders(0,10);
                                                                                    }else{
                                                                                        $Pages = GetLimitOrders( ( ($page-1)*10)-1,10);
                                                                                    }
                                                                                    while($row = $Pages->fetch_assoc()) {
                                                                                        echo'
                                                                                        <option value="'.$row[OrderID].'">'.$row[ProductName].'('.$row[OrderID].')'.'</option>
                                                                                        ';
                                                                                    }
                                                                                ?>
                                                                                
                                                                            </select>
                                                                            <i></i>
                                                                        </label>
                                                                    </div>

                                                                    <div class="j-unit">
                                                                        <label class="j-input j-select">
                                                                        <select name="ChangeStatus">
                                                                            <option value="" selected="">Choose your order</option>
                                                                            <option value="0">Applied</option>
                                                                            <option value="2">Rejected</option>
                                                                            <option value="1">Approved</option>
                                                                            <option value="3">Completed</option>
                                                                            </select>
                                                                            <i></i>
                                                                        </label>
                                                                    </div>
                                                                
                                                                <!-- end country -->
                                                                    
                                                                <div class="j-footer">
                                                                    <button type="submit" name="ChangeButton" class="btn btn-primary">Change</button>
                                                                </div>
                                                                <!-- end /.footer -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Ready suggestion card end -->
                                            </div>
                                        </div>
                                    </div>

                                   <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Ready suggestion card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Remove The Order</h5>
                                                        <span>If you want delete one product,you only must do select one item</span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="j-wrapper j-wrapper-640">
                                                            <form method="post" class="j-pro" novalidate="">
                                                                <!-- end /.header-->
                                                                <div class="j-content">
                                                                    <div class="j-unit">
                                                                        <label class="j-input j-select">
                                                                                <select name="removeOrderID">
                                                                                    <option value="" selected="">Choose your person</option>
                                                                                    <?php
                                                                                        if($page == 1){
                                                                                            $Pages = GetLimitOrders(0,10);
                                                                                        }else{
                                                                                            $Pages = GetLimitOrders( ( ($page-1)*10)-1,10);
                                                                                        }
                                                                                        while($row = $Pages->fetch_assoc()) {
                                                                                            echo'
                                                                                            <option value="'.$row[OrderID].'">'.$row[ProductName].'('.$row[OrderID].')'.'</option>
                                                                                            ';
                                                                                        }
                                                                                    ?>
                                                                                    
                                                                                </select>
                                                                                <i></i>
                                                                            </label>
                                                                    </div>
                                                                <!-- end country -->
                                                                    
                                                                <div class="j-footer">
                                                                    <button type="submit" name="Remove" class="btn btn-primary">Remove</button>
                                                                </div>
                                                                <!-- end /.footer -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Ready suggestion card end -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

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
    <script type="text/javascript" src="..\admin\files\bower_components\jquery\js\jque.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- j-pro js -->
    <script type="text/javascript" src="..\admin\files\assets\pages\j-pro\js\jquery.ui.min.js"></script>
    <script type="text/javascript" src="..\admin\files\assets\pages\j-pro\js\jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="..\admin\files\assets\pages\j-pro\js\jquery.j-pro.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="..\admin\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="..\admin\files\bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\modernizr\js\css-scrollbars.js"></script>

    <!-- i18next.min.js -->
    <script type="text/javascript" src="..\admin\files\bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="..\admin\files\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>


    <script src="..\admin\files\assets\js\pcoded.min.js"></script>
    <script src="..\admin\files\assets\js\vartical-layout.min.js"></script>
    <script src="..\admin\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="..\admin\files\assets\js\script.js"></script>
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
