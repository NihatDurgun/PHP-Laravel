<?php include("header.php"); myordersactive(); ?>
<?php
	include getcwd().'/src/DatabaseOperation.php';
	$Data = GetPageDatas("myorders");
?>


<!DOCTYPE html>
<html lang="en">
<head>
		<?php
			echo'
				<title>'.$Data[header].'</title>
			';
		?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="shopping/images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="shopping/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/css/util.css">
	<link rel="stylesheet" type="text/css" href="shopping/css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
	

<section class="unique-feature-area section-gap" id="unique">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10 text-white"><?php echo $Data[mainTitle];?></h1>
								<p><?php echo $Data[mainTitleDesc];?></p>
							</div>
						</div>
					</div>						
						<div class="progress-table-wrap">
							<div class="progress-table">
								<div class="table-head">
									<div class="serial">#</div>
									<div class="country">Company</div>
									<div class="country">Product</div>
									<div class="country">Amount</div>
									<div class="country">Price</div>
									<div class="country">Status</div>
									<div class="country">Date</div>

								</div>
								<?php
									session_start();  
									$Orders = GetOrders($_SESSION["userid"]);

									$i=1;
									while($row = $Orders->fetch_assoc()) {
										echo'
											<div class="table-row">
												<div class="serial">'.$i.'</div>
												<div class="country">'.$row[userName].'</div>
												<div class="country">'.$row[ProductName].'</div>
												<div class="country">'.$row[OrderCount].'</div>
												<div class="country">'.$row[price].'</div>';
												switch($row[ordersStatus]){
													case 0: echo '<div class="country"><font color ="#20A0E9">applied</font></div>'; 		break;
													case 1: echo '<div class="country"><font color ="#2051E9">approved</font></div>'; 	break;
													case 2: echo '<div class="country"><font color ="#E92020">rejected</font></div>'; 	break;
													case 3: echo '<div class="country"><font color ="#20E9A9">completed</font></div>'; 	break;
												}
												
												
												echo '<div class="country">'.$row[OrderDate].'</div>
											</div>';
										$i+=1;
									}
								?>
							</div>
						</div>
					</div>
				</div>	

			</section>
		
	
		
</body>
<!--===============================================================================================-->
	<script src="shopping/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="shopping/vendor/bootstrap/js/popper.js"></script>
	<script src="shopping/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="shopping/vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="shopping/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="shopping/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="shopping/js/main.js"></script>
	
	<script src="shopping/vendor/isotope/isotope.pkgd.min.js"></script>
	<script src="shopping/vendor/sweetalert/sweetalert.min.js"></script>
	<script>

		/*---------------------------------------------*/
		
		$('.js-addcart-detail').each(function(){
			$(this).on('click', function(){
				var a = document.forms["Form"]["address"].value;
				if(a != null && a != ""){
					//swal("Order completed.", "Please wait for the order to be approved!","success");
					window.location.href = 'index.php?Status=Success';
				}
			});
		});
	
	</script>

	


	
</body>
</html>


<?php
	session_start(); 

    $login = false;
    if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
        $login = true;
	}
	if(!$login){
		echo "<script type='text/javascript'>window.top.location='myorders.php';</script>"; exit;
	}
	 
?>