<?php include("header.php"); shopactive(); ?>

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
		<title>Watch</title>

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




			<section class="unique-feature-area section-gap" id="unique">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10 text-white">Some Features that Made us Unique</h1>
								<p>Who are in extremely love with eco friendly system.</p>
							</div>
						</div>
					</div>						
					
							<?php
								session_start();  
								include getcwd().'/src/DatabaseOperation.php';
								$page = intval($_GET['page']);
								if(is_null($page) || $page == 0){
									$page=1;
								}
								echo "<script>console.log((($page-1)*20))</script>";
								echo "<script>console.log($page*20)</script>";
								if($page == 1){
									$Products = GetLimitProducts(0,20);
								}else{
									$Products = GetLimitProducts( ( ($page-1)*20),20);
								}
								$i=0;
								echo'<div class="row">';
								while($row = $Products->fetch_assoc()) {
									echo '
									<div class="col-lg-3 col-md-6">
									<form method="post" action="product-detail.php">
									<div class="single-unique-product">
										<img class="img-fluid" src="img/u1.jpg" alt="">
										<div class="desc">
											<h4>
											'.$row[ProductName].'
											</h4>
											<input type="hidden" name="ProductID" value="'.$row[ProductID].'">
											<h6>'.$row[price].'</h6>
											<input type="submit" name="foo" value="View" class="text-uppercase primary-btn" />  
										</div>
										</div>
										</form>
										</div>
									';
									$i+=1;
									if($i % 4 == 0 ){
										echo '</div>';
										echo'<div class="row">';
									}
									
								}
							?>
					
				</div>	

				<br><br><br>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">
					<?php

						  $TotalCount =GetProductsCount();
						  $TotalPage = ceil($TotalCount / 20.0);
						  echo "<script>console.log($page)</script>";
						  echo "<script>console.log($TotalPage)</script>";
				   
						  if(intval($page) < $TotalPage && intval($page) != 1){
							echo '<script>console.log("g1")</script>';
							  echo'
							  <li class="page-item ">
							  <a class="page-link" href="shop.php?page='.($page-1).'" tabindex="-1"><b>Previous</b></a>
							  </li>';
							  echo'
							  <li class="page-item"><a class="page-link" href="shop.php?page='.($page-1).'"><b>'.($page-1).'</b></a></li>
							  <li class="page-item"><a class="page-link" href="shop.php?page='.$page.'"><b>'.$page.'</b></a></li>
							  <li class="page-item"><a class="page-link" href="shop.php?page='.($page+1).'"><b>'.($page+1).'</b></a></li>
							  <li class="page-item">
							  ';
							  echo'
								  <li class="page-item">
								  <a class="page-link" href="shop.php?page='.($page+1).'" ><b>Next</b></a>
								  </li>
							  ';
							}else if(intval($page) == $TotalPage && $page == 1){
								echo '<script>console.log("g2")</script>';
								echo'
								<li class="page-item disabled">
								<a class="page-link" href="shop.php?page='.($page-1).'" tabindex="-1" disabled><b>Previous</b></a>
								</li>';
								echo'
								<li class="page-item"><a class="page-link" href="shop.php?page=1"><b>1</b></a></li>
								';
								echo'
								<li class="page-item disabled">
								<a class="page-link" href="shop.php?page='.($page+1).'" disabled><b>Next</b></a>
								</li>
							';
							}
						  
						  else if(intval($page) == $TotalPage){
							echo '<script>console.log("g3")</script>';
							echo'
							<li class="page-item ">
							<a class="page-link" href="shop.php?page='.($page-1).'" tabindex="-1"><b>Previous</b></a>
							</li>';
							echo'
							
							<li class="page-item"><a class="page-link" href="shop.php?page='.($page-2).'" disabled><b>'.($page-2).'</b></a></li>
							<li class="page-item"><a class="page-link" href="shop.php?page='.($page-1).'" disabled><b>'.($page-1).'</b></a></li>
							<li class="page-item"><a class="page-link" href="shop.php?page='.($page).'"><b>'.($page).'</b></a></li>
							';
							echo'
							<li class="page-item disabled">
							<a class="page-link" href="shop.php?page='.($page+1).'" disabled><b>Next</b></a>
							</li>
						';
						}
						  else if(intval($page) == 1){
							echo '<script>console.log("g4")</script>';
							  echo'
							  <li class="page-item disabled">
							  <a class="page-link" href="shop.php?page='.($page-1).'" tabindex="-1" disabled><b>Previous</b></a>
							  </li>';
							  echo'
							  <li class="page-item"><a class="page-link" href="shop.php?page=1"><b>1</b></a></li>
							  <li class="page-item"><a class="page-link" href="shop.php?page='.($page+1).'"><b>'.($page+1).'</b></a></li>
							  <li class="page-item"><a class="page-link" href="shop.php?page='.($page+2).'"><b>'.($page+2).'</b></a></li>
							  <li class="page-item">
							  ';
							  echo'
							  <li class="page-item">
							  <a class="page-link" href="shop.php?page='.($page+1).'" ><b>Next</b></a>
							  </li>
						  ';
						  }
					?>
				</ul>
				</nav>
			</section>




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
	</html>



