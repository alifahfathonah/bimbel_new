<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Favicon icon -->
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/elite_admin/images/favicon.png'); ?>">
		<title>Elite Admin Template - The Ultimate Multipurpose admin template</title>
		<!-- Custom CSS -->
		<link href="<?php echo base_url('assets/elite_admin/dist/css/style.min.css'); ?>" rel="stylesheet">
		<?php if(isset($css)){ echo $css; } ?>
		
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="<?php echo base_url('assets/elite_admin/node_modules/jquery/jquery-3.2.1.min.js'); ?>"></script>
		<!-- Bootstrap popper Core JavaScript -->
		<script src="<?php echo base_url('assets/elite_admin/node_modules/popper/popper.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/elite_admin/node_modules/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
		<!-- slimscrollbar scrollbar JavaScript -->
		<script src="<?php echo base_url('assets/elite_admin/dist/js/perfect-scrollbar.jquery.min.js'); ?>"></script>
		<!--Wave Effects -->
		<script src="<?php echo base_url('assets/elite_admin/dist/js/waves.js'); ?>"></script>
		<!--Menu sidebar -->
		<script src="<?php echo base_url('assets/elite_admin/dist/js/sidebarmenu.js'); ?>"></script>
		<!--Custom JavaScript -->
		<script src="<?php echo base_url('assets/elite_admin/dist/js/custom.min.js'); ?>"></script>
		<!--stickey kit -->
		<script src="<?php echo base_url('assets/elite_admin/node_modules/sticky-kit-master/dist/sticky-kit.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/elite_admin/node_modules/sparkline/jquery.sparkline.min.js'); ?>"></script>
	
		<?php if(isset($js)){ echo $js; } ?>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

<body class="horizontal-nav skin-megna fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
		<?php $this->load->view('template/header'); ?>
		<?php $this->load->view('template/aside'); ?>
		<?php $this->load->view($page); ?>
		<?php $this->load->view('template/footer'); ?>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
</body>

</html>