<?php include("header.php"); aboutactive(); ?>
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
		<?php
			include getcwd().'/src/DatabaseOperation.php';
			$Data = GetPageDatas("about");
			echo'
				<title>'.$Data[header].'</title>
			';
		?>
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
			echo'
			<!-- start banner Area -->
			<section class="generic-banner relative">	
				<div class="container">
					<div class="row height align-items-center justify-content-center">
						<div class="col-lg-10">
							<div class="generic-banner-content">
								<h2 class="text-white">'.$Data[mainTitle].'</h2>
								<p class="text-white">'.$Data[mainTitleDesc].'</p>
							</div>							
						</div>
					</div>
				</div>
			</section>		
			<!-- End banner Area -->
			';
		?>

			<!-- Start Generic Area -->
			<section class="about-generic-area section-gap">
				<div class="container border-top-generic">
					<h3 class="about-title mb-30">Elaboration about Generic Page</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="img-text">
								<img src="img/a.jpg" alt="" class="img-fluid float-left mr-20 mb-20">
								<p>Recently, the US Federal government banned online casinos from operating in America by making it illegal to transfer money to them through any US bank or payment system. As a result of this law, most of the popular online casino networks such as Party Gaming and PlayTech left the United States. Overnight, online casino players found themselves being chased by the Federal government. But, after a fortnight, the online casino industry came up with a solution and new online casinos started taking root. These began to operate under a different business umbrella, and by doing that, rendered the transfer of money to and from them legal. A major part of this was enlisting electronic banking systems that would accept this new clarification and start doing business with me. Listed in this article are the electronic banking systems that accept players from the United States that wish to play in online casinos.</p>
							</div>
						</div>
						<div class="col-lg-12">
							<p>Recently, the US Federal government banned online casinos from operating in America by making it illegal to transfer money to them through any US bank or payment system. As a result of this law, most of the popular online casino networks such as Party Gaming and PlayTech left the United States. Overnight, online casino players found themselves being chased by the Federal government. But, after a fortnight, the online casino industry came up with a solution and new online casinos started taking root. These began to operate under a different business umbrella, and by doing that, rendered the transfer of money to and from them legal. A major part of this was enlisting electronic banking systems that would accept this new clarification and start doing business with me. Listed in this article are the electronic banking systems that accept players from the United States that wish to play in online casinos.</p>
						</div>
						<div class="col-lg-12">
							<p>Recently, the US Federal government banned online casinos from operating in America by making it illegal to transfer money to them through any US bank or payment system. As a result of this law, most of the popular online casino networks such as Party Gaming and PlayTech left the United States. Overnight, online casino players found themselves being chased by the Federal government. But, after a fortnight, the online casino industry came up with a solution and new online casinos started taking root. These began to operate under a different business umbrella, and by doing that, rendered the transfer of money to and from them legal. A major part of this was enlisting electronic banking systems that would accept this new clarification and start doing business with me. Listed in this article are the electronic banking systems that accept players from the United States that wish to play in online casinos.</p>
						</div>
						<div class="col-md-12">
							<div class="img-text">
								<img src="img/a2.jpg" alt="" class="img-fluid float-left mr-20 mb-20">
								<p>Recently, the US Federal government banned online casinos from operating in America by making it illegal to transfer money to them through any US bank or payment system. As a result of this law, most of the popular online casino networks such as Party Gaming and PlayTech left the United States. Overnight, online casino players found themselves being chased by the Federal government. But, after a fortnight, the online casino industry came up with a solution and new online casinos started taking root. These began to operate under a different business umbrella, and by doing that, rendered the transfer of money to and from them legal. A major part of this was enlisting electronic banking systems that would accept this new clarification and start doing business with me. Listed in this article are the electronic banking systems that accept players from the United States that wish to play in online casinos.</p>
							</div>
						</div>

						<html>
						<head>
							<style>
							/* Set the size of the div element that contains the map */
							#map {
								height: 400px;  /* The height is 400 pixels */
								width: 100%;  /* The width is the width of the web page */
							}
							</style>
						</head>
						<body>
							<!--The div element for the map -->
							<div id="map"></div>
							<script>
						// Initialize and add the map
						function initMap() {
						// The location of Uluru
						var uluru = {lat: -25.344, lng: 131.036};
						// The map, centered at Uluru
						var map = new google.maps.Map(
							document.getElementById('map'), {zoom: 4, center: uluru});
						// The marker, positioned at Uluru
						var marker = new google.maps.Marker({position: uluru, map: map});
						}
							</script>
							<!--Load the API from the specified URL
							* The async attribute allows the browser to render the page while the API loads
							* The key parameter will contain your own API key (which is not needed for this tutorial)
							* The callback parameter executes the initMap() function
							-->
							<script async defer
							src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
							</script>
						</body>
				</html>

					</div>
				</div>

				

			</section>
			<!-- End banner Area -->	

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



