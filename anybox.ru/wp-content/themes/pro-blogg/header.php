<!DOCTYPE html>
<?php $options = get_option( 'dess_settings' ); ?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,500,700,900' rel='stylesheet' type='text/css'>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body <?php body_class(); ?>>
	<header id="head">
		<div class="head-top">		
			<div class="container">
				<div class="head-nav">
					<?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
				</div>
				<div class="head-search">
					<?php get_search_form(); ?>
				</div>
				<div class="head-socials">
					<ul>
						<?php
							$socials = array('twitter','facebook','google-plus','instagram','pinterest','vimeo','youtube','linkedin');
							for($i=0;$i<count($socials);$i++){
								$url = '';
								$s = $socials[$i];
								$url = dess_options($s.'_url');
								echo ($url != '' ? '<li><a target="_blank" href="'.$url.'"><img src="'.esc_url( get_stylesheet_directory_uri() ).'/images/'.$s.'-icon.png" alt="'.$s.'" /></a></li>':'');
							}
						?>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="head-logo">
			<div class="container">
				<div class="logo">
					<?php echo (dess_options('logo') != '' ? '<a href="'.home_url().'"><img src="'.dess_options('logo').'" class="logo" alt="logo" /></a>': '<a href="'.home_url().'"><img src="'.esc_url( get_stylesheet_directory_uri() ).'/images/logo.png" class="logo" alt="logo" /></a>'); ?>	
					<?php //echo '<a href="'.home_url().'"><img src="'.get_header_image().'" class="logo" alt="logo" /></a>'; ?>	
				</div>
			</div>
		</div>
	</header>