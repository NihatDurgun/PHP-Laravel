<?php include("header.php"); shopactive(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Detail</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel="stylesheet" type="text/css" href="shopping/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="shopping/css/util.css">
	<link rel="stylesheet" type="text/css" href="shopping/css/main.css">

			<link rel="stylesheet" type="text/css" href="shopping/css/util.css">
			<link rel="stylesheet" type="text/css" href="shopping/css/main.css">
		</head>


		<?php
			include getcwd().'/src/DatabaseOperation.php';
			if(is_null($_POST["ProductID"])){
				echo "<script type='text/javascript'>window.top.location='shop.php';</script>"; exit;
			}
			$Product = GetProduct($_POST["ProductID"]);
			$row = $Product->fetch_assoc();
			echo "<br><br><br>";	
			
			if(empty( $row[picture])){
				echo '
					<div class="col-lg-3 col-md-6">
					<form method="post" action="product-detail.php">
							<div class="single-unique-product">
									<img width="146" height="245" src="NoImage.png" alt="">
										<div class="desc">
											<h2>
											'.$row[ProductName].'
											</h2>
					<input type="hidden" name="ProductID" value="'.$row[ProductID].'">
					<h10 align ="left">
					'.$row[productDescription].'
					</h10>
					</div></div></form></div>';
			}else{
				echo '
					<div class="card mx-auto flex-xs-middle  col-10 col-lg-3" style="align-items: center;vertical-align: middle;">
						<img class="card-img-top"   style="margin-top:5%;margin-bottom:5%;max-width:80%" src="data:image/jpeg;base64,'.base64_encode( $row[picture] ).'" alt=""/>
					</div>';

					echo '<br>
					<div style="margin-bottom:10%">
					<div class="card mx-auto flex-xs-middle col-10 col-lg-3 ">
						<div class="card-body" >
						<h3 class="card-title">'.$row[ProductName].'</h3>
						<p class="card-text" style="font-size:12px;color:black;font-weight:300;">'.nl2br($row[productDescription],false).' </p>
					
						<div class="wrap-num-product flex-w m-l-auto m-r-12">
							<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
								<i class="fs-16 zmdi zmdi-minus"></i>
							</div>

							<input class="mtext-104 cl3 txt-center num-product" type="number" name="Amount" value="1">

							<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
								<i class="fs-16 zmdi zmdi-plus"></i>
							</div>
						</div>
						<div class="float-right flex-w m-l-auto m-r-0" style="margin-top:10px;">
						<input type="submit" name="AddCard" value="Add To Card" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" />
						</div>
						
						</div>
					</div>
					</div>';
			}	
	?>
					

</div>	
	
</head>
						
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
<!--===============================================================================================-->
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
	<script src="shopping/vendor/daterangepicker/moment.min.js"></script>
	<script src="shopping/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="shopping/vendor/slick/slick.min.js"></script>
	<script src="shopping/js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="shopping/vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="shopping/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="shopping/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="shopping/vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/
		
		$('.js-go-login').each(function(){
			$(this).on('click', function(){
				window.top.location='login.php';
			});
		});
	</script>
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
<!--===============================================================================================-->

</body>
</html>


<?php
	if(is_null($_POST["ProductID"])){
		echo "<script type='text/javascript'>window.top.location='shop.php';</script>"; exit;
	}else{
		session_start();
		if(!is_null($_POST["AddCard"])){
			if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
				
				$Product = GetProduct($_POST["ProductID"]);
				$row = $Product->fetch_assoc();
				$Price = $_POST["Amount"] * $row[price];
				if(is_null($_SESSION["MyOrderCache"])){
					$_SESSION["MyOrderCache"] = array(array("ProductID","Amount","Price"));
				}
				$isfound = false;
				$i=0;
				foreach($_SESSION["MyOrderCache"] as $item) {
					if($item[0] == $_POST["ProductID"]){
						$isfound = true;
						$_SESSION["MyOrderCache"][$i][1] = $item[1] + $_POST["Amount"];
						$_SESSION["MyOrderCache"][$i][2] = $item[1] * $Price;
					}
					$i++;
				}
				if($isfound == false){
					array_push($_SESSION["MyOrderCache"],array($_POST["ProductID"],$_POST["Amount"],$Price));
				}
				print_r($_SESSION["MyOrderCache"]);
				echo '<script type="text/javascript">',
				'swal("'.$row[ProductName].'", "is added to cart !", "success");',
				'</script>';
			}else{
				echo "<script type='text/javascript'>window.top.location='login.php';</script>"; exit;	
			}
		}
	}



?>