<!-- === BEGIN HEADER === -->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<!-- Title -->
	<title></title>
	<script language="JavaScript">
		var txt="Sistem Informasi Praktikum - Teknik Elektro-";
		var kecepatan=500;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
	<!-- Meta -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url();?>ubhara.ico">
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
	<!-- Template CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/nexus.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
	<!-- Google Fonts-->
	<link href="http://fonts.googleapis.com/css?family=Lato:400,300" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="pre_header" class="visible-lg"></div>
		<div id="header" class="container">
			<div class="row">
				<!-- Logo -->
				<div class="logo">
					<a href="index.html" title="">
						<img src="<?php echo base_url();?>assets/img/logo.png" alt="Logo" />
					</a>
				</div>
				<!-- End Logo -->
				<!-- Top Menu -->
				<div class="col-md-12 margin-top-30">

					<?php echo $navbar; ?>

				</div>
					<div class="clear">

					</div>

				<!-- End Top Menu -->
			</div>
		</div>
		<!-- === END HEADER === -->
		<!-- === BEGIN CONTENT === -->
		<div id="content" class="container">
			<div class="row margin-top-30">
			<div class="pull-right">Selamat Datang, <?php echo $this->session->userdata('NAMA_USER')?></div>
				<div class="col-md-12 text-center">
					<h2 class"text-center">Bring something special to your site with this fresh &amp; clean design</h2>
					<p class"text-center">Aenean venenatis egestas iaculis. Nullam consectetur condimentum dolor at bibendum. Nulla in enim quis ipsum pulvinar imperdiet.</p>
				</div>
			</div>
			<div class="row margin-top-10">
				<!-- Carousel Slideshow -->
				<div id="carousel-example" class="carousel slide" data-ride="carousel">
					<!-- Carousel Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example" data-slide-to="1"></li>
						<li data-target="#carousel-example" data-slide-to="2"></li>
					</ol>
					<!-- End Carousel Indicators -->
					<!-- Carousel Images -->
					<div class="carousel-inner">
						<div class="item active">
							<img src="assets/img/slideshow/slide1.jpg">
						</div>
						<div class="item">
							<img src="assets/img/slideshow/slide2.jpg">
						</div>
						<div class="item">
							<img src="assets/img/slideshow/slide3.jpg">
						</div>
						<div class="item">
							<img src="assets/img/slideshow/slide4.jpg">
						</div>
					</div>
					<!-- End Carousel Images -->
					<!-- Carousel Controls -->
					<a class="left carousel-control" href="#carousel-example" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
					<!-- End Carousel Controls -->
				</div>
				<!-- End Carousel Slideshow -->
			</div>
			<div class="row margin-vert-30">
				<!-- Main Text -->
				<div class="col-md-9">
					<h2>Nulla in enim quis</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nec suscipit magna. Suspendisse lacinia interdum felis eu consectetur. Vivamus sit amet ante est, sit amet rutrum augue. Cras non sem sem, at eleifend mi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Aenean venenatis egestas iaculis. Nullam consectetur condimentum dolor at bibendum.Nulla in enim quis ipsum pulvinar imperdiet vitae nec velit. Donec non urna quam.</p>
					<a class="btn btn-default" href="#">
						Read More
						<i class="fa-chevron-right"></i>
					</a>
				</div>
				<!-- End Main Text -->
				<!-- Side Column -->
				<div class="col-md-3">
					<h3 class="margin-bottom-10">Sample Menu</h3>
					<ul class="menu">
						<li>
							<a class="fa-angle-right" href="#" >Placerat facer possim</a>
						</li>
						<li>
							<a class="fa-angle-right" href="#" >Quam nunc putamus</a>
						</li>
						<li>
							<a class="fa-angle-right" href="#" >Velit esse molestie</a>
						</li>
						<li>
							<a class="fa-angle-right" href="#" >Nam liber tempor</a>
						</li>
					</ul>
				</div>
				<!-- End Side Column -->
			</div>
			<div class="row">
				<!-- Portfolio -->
				<!-- Portfolio Item -->
				<div class="portfolio-item col-sm-4 animate fadeIn">
					<div class="image-hover">
						<a href="#">
							<figure>
								<img src="assets/img/frontpage/filler1.jpg" alt="image1">
								<div class="overlay">
									<a class="expand" href="#">Image Link</a>
								</div>
							</figure>
							<h3 class="margin-top-20">Quam putamus</h3>
							<p class="margin-top-10 margin-bottom-20">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
							<div class="btn btn-default">
								<a class="info" href="http://localhost/build/substance/index.php/quam-nunc-putamus">Read more</a>
							</div>
						</a>
					</div>
				</div>
				<!-- //Portfolio Item// -->
				<!-- Portfolio Item -->
				<div class="portfolio-item col-sm-4 animate fadeIn">
					<div class="image-hover">
						<a href="#">
							<figure>
								<img src="assets/img/frontpage/filler2.jpg" alt="image2">
								<div class="overlay">
									<a class="expand" href="#">Image Link</a>
								</div>
							</figure>
							<h3 class="margin-top-20">Quam putamus</h3>
							<p class="margin-top-10 margin-bottom-20">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
							<div class="btn btn-default">
								<a class="info" href="http://localhost/build/substance/index.php/quam-nunc-putamus">Read more</a>
							</div>
						</a>
					</div>
				</div>
				<!-- //Portfolio Item// -->
				<!-- Portfolio Item -->
				<div class="portfolio-item col-sm-4 animate fadeIn">
					<div class="image-hover">
						<a href="#">
							<figure>
								<img src="assets/img/frontpage/filler3.jpg" alt="image3">
								<div class="overlay">
									<a class="expand" href="#">Image Link</a>
								</div>
							</figure>
							<h3 class="margin-top-20">Quam putamus</h3>
							<p class="margin-top-10 margin-bottom-20">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
							<div class="btn btn-default">
								<a class="info" href="http://localhost/build/substance/index.php/quam-nunc-putamus">Read more</a>
							</div>
						</a>
					</div>
				</div>
				<!-- //Portfolio Item// -->
				<!-- End Portfolio -->
			</div>
			<div class="row">
				<h2 class="text-center margin-top-10">Nulla in enim quis ipsum pulvinar imperdiet vitae nec velit..</h2>
				<p class="text-center margin-bottom-30">Aenean venenatis egestas iaculis. Donec non urna quam. Nullam consectetur condimentum dolor at bibendum.</p>
			</div>
		</div>
	</div>
	<!-- === END CONTENT === -->
	<!-- === BEGIN FOOTER === -->
		<!-- Footer Menu -->
		<div id="footer">
			<div class="container">
				<div class="row">
					<div id="copyright" class="col-md-4">
						<p>(c) 2014 Your Copyright Info</p>
					</div>
					<div id="footermenu" class="col-md-8">
						<ul class="list-unstyled list-inline pull-right">
							<li>
								<a href="#" target="_blank" >Sample Link</a>
							</li>
							<li>
								<a href="#" target="_blank" >Sample Link</a>
							</li>
							<li>
								<a href="#" target="_blank" >Sample Link</a>
							</li>
							<li>
								<a href="#" target="_blank" >Sample Link</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Footer Menu -->
</div>
</div>
<!-- JS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/scripts.js"></script>
<!-- Isotope - Portfolio Sorting -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.isotope.js" type="text/javascript"></script>
<!-- Mobile Menu - Slicknav -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slicknav.js" type="text/javascript"></script>
<!-- Animate on Scroll-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.visible.js" charset="utf-8"></script>
<!-- Slimbox2-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/slimbox2.js" charset="utf-8"></script>
<!-- Modernizr -->
<script src="<?php echo base_url();?>assets/js/modernizr.custom.js" type="text/javascript"></script>
<!-- End JS -->
</body>
</html>
<!-- === END FOOTER === -->
