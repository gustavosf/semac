<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo (isset($title) ? $title." | " : "")."SEMAC"; ?></title>
	<meta name="description" content="">
	<meta name="author" content="Gustavo Seganfredo, Glauber Hermany">

	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS: implied media="all" -->
	<?php echo Asset::css('bootstrap.min.css'); ?>
	<?php echo Asset::css('semac.css'); ?>
	<?php echo Asset::css('semac.admin.css'); ?>
	<?php echo Asset::css('smoothness/jquery-ui-1.8.16.custom.css'); ?>


	<!-- JavaScript at the bottom for fast page loading -->
	<?php echo Asset::js('jquery/jquery-1.6.4.js'); ?>
	<?php echo Asset::js('jquery/jquery-ui-1.8.16.custom.min.js'); ?>
	<?php echo Asset::js('bootstrap/bootstrap-dropdown.js'); ?>
	<?php echo Asset::js('bootstrap/bootstrap-alerts.js'); ?>
	<?php echo Asset::js('bootstrap/bootstrap-twipsy.js'); ?>

	<!-- scripts concatenated and minified via ant build script -->
	<?php echo Asset::js('application.js'); ?>
	<!-- end scripts-->


	<?php if (isset($ogtags)): ?>
		<!-- More ideas for your <head> here: h5bp.com/docs/#head-Tips -->
		<!-- Facebook Open Graph: Display information -->
		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" />
	<?php endif; ?>
</head>

<body>
	<?php echo $interface_topbar; ?>

	<div class="container">
		<?php echo $content ?>
	</div> <!-- /container -->

</body>
</html>