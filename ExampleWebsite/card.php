<?php include("header.php"); cardactive(); ?>
<?php
	include getcwd().'/src/DatabaseOperation.php';
	$Data = GetPageDatas("card");
?>

<?php 

	session_start();
	$id = intval($_GET['id']);
	$amount = intval($_GET['amount']);
	$operation = intval($_GET['operation']);

	if(!is_null($id) && !is_null($operation)){
		
		for ($i = 1; $i < count($_SESSION["MyOrderCache"]); $i++) {
			if($_SESSION["MyOrderCache"][$i][0] == $id){
				if($operation == 1){
					$Price = $_SESSION["MyOrderCache"][$i][2] /$_SESSION["MyOrderCache"][$i][1];
					$_SESSION["MyOrderCache"][$i][1] =  $amount;
					$_SESSION["MyOrderCache"][$i][2] = $Price * $_SESSION["MyOrderCache"][$i][1];
				}else if($operation == 2){
					unset($_SESSION["MyOrderCache"][$i]);
				}
			}
		}
	}
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
	


	<!-- Shoping Cart -->
	<form name="Form" class="bg0 p-t-75 p-b-85" method="post">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-1">Operation</th>
									<th class="column-3"></th>
								</tr>
			
			<?php
				session_start();
				$TotalPrice =0;

				for ($i = 1; $i < count($_SESSION["MyOrderCache"]); $i++) {
					$Product = GetProduct($_SESSION["MyOrderCache"][$i][0]);
					$TotalPrice += $_SESSION["MyOrderCache"][$i][2];
					$row = $Product->fetch_assoc();
					if(empty( $row[picture])){
						echo '
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img width="60" height="80" src="NoImage.png" alt="IMG">
										</div>
									</td>';
					}else{
						echo '
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img width="60" height="80" src="data:image/jpeg;base64,'.base64_encode( $row[picture] ).'" alt=""/>
										</div>
									</td>';
					}
					echo'
									<td class="column-2">'.$row[ProductName].'</td>
									<td class="column-3">'.$row[price].'</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="valuechange('.$_SESSION["MyOrderCache"][$i][1].',-1)">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" onchange="valuechange('.$_SESSION["MyOrderCache"][$i][1].',0)" type="number" id="Amount" value="'.$_SESSION["MyOrderCache"][$i][1].'">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="valuechange('.$_SESSION["MyOrderCache"][$i][1].',+1)">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">'.$_SESSION["MyOrderCache"][$i][2].'</td>
									<td class="column-1">
										<img src="shopping/images/refresh-inactive.png"  id="ref-inactive" alt="IMG" height="32" width="32">
										<img src="shopping/images/refresh.png" alt="IMG" onclick="update('.$_SESSION["MyOrderCache"][$i][0].')" id="ref-active"  style="display: none;" height="32" width="32">
										<img src="shopping/images/trash.png" alt="IMG" onclick="remove('.$_SESSION["MyOrderCache"][$i][0].')" height="32" width="32">
									</td>

									<td class="column-3"></td>
								</tr>';
				}
			?>		
							</table>
						</div>

					</div>
				</div>
			
				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										<b><center>Address</center></b>
									</span>

									<div class="bor8 bg0 m-b-12">
									<textarea class="form-control" rows="3" name="address" placeholder="Enter your address clearly" required></textarea>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									<?php echo '€'.$TotalPrice;?>
								</span>
							</div>
						</div>
							<input type="submit" name="Checkout" value="Proceed to Checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer js-addcart-detail" /> 
					</div>
				</div>
			</div>
		</div>
	</form>
		
	
		

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
	<script>
		function valuechange(data,choice){

			var amount = parseInt(document.getElementById("Amount").value) + parseInt(choice);
			console.log(amount);
			if(amount !=  parseInt(data))
			{
				document.getElementById("ref-inactive").style.display = "none";
				document.getElementById("ref-active").style.display = "";
			}else{
				document.getElementById("ref-inactive").style.display = "";
				document.getElementById("ref-active").style.display = "none";
			}

		}

		function update(ProductID){
			var amount = parseInt(document.getElementById("Amount").value);
			window.location = "card.php?id="+ProductID+"&amount="+amount+"&operation=1";
			
		}

		function remove(ProductID){
			var amount = parseInt(document.getElementById("Amount").value);
			window.location = "card.php?id="+ProductID+"&amount="+amount+"&operation=2";
			
		}
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

if(!is_null($_POST["Checkout"])){
	$addres = $_POST["address"];
	for ($i = 1; $i < count($_SESSION["MyOrderCache"]); $i++) {
		PushOrder($_SESSION["MyOrderCache"][$i][0],$_SESSION["userid"],$_SESSION["MyOrderCache"][$i][1],$_POST["address"]);
		unset($_SESSION["MyOrderCache"]);
		echo '<script>swal("Order completed.", "Please wait for the order to be approved!","success");</script>';
	}

}

	session_start(); 

    $login = false;
    if ($_SESSION["userid"] != -1 && !(is_null($_SESSION["userid"])) ){
        $login = true;
	}
	if(!$login){
		echo "<script type='text/javascript'>window.top.location='login.php';</script>"; exit;
	}
	 
?>