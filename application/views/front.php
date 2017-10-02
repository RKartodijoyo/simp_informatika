<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Title -->
		<title></title>
		<script language="JavaScript">
		var txt="Sistem Informasi Praktikum - Teknik Elektro-";
		var kecepatan=500;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
		</script>
		<link rel="shortcut icon" href="<?php echo base_url();?>ubhara.ico">
        <!-- Meta -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <!-- Favicon -->
        <link href="favicon.html" rel="shortcut icon">
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
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/jquery/jquery-ui.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/jquery/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" />

        <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/style.default.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/jquery.gritter.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/jquery.datatables.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/back/css/select2.min.css" />
    </head>
    <body style="background-color:#eeeeee">

        <div id="pre_header" class="visible-lg"></div>
            <div id="header" class="container">
                <?php echo $contents; ?>
            </div>
        </div><!-- /container -->

        <script src="<?php echo base_url();?>assets/jquery/jquery-ui.min.js"></script>
        <script src="<?php echo base_url();?>assets/jquery/jquery-ui.min.js"></script>
        <script src="<?php echo base_url();?>assets/jquery/jquery.form.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url();?>assets/back/js/jquery.gritter.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/dataTables/jquery.dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/jquery.noty.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/themes/default.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/layouts/bottom.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/layouts/topRight.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/layouts/top.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/toggles.min.js"></script>
        <script src="<?php echo base_url();?>assets/back/js/jquery.cookies.js"></script>

        <script src="<?php echo base_url();?>assets/back/js/custom.js"></script>
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
