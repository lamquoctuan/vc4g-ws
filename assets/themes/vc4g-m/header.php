<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon" />

	<title>
		<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
	</title>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<?php wp_head(); ?>
</head>

<body id="page-top" class="index">
<?php
    get_template_part( 'template/home', 'nav' );
?>